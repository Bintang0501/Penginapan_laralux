<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Keranjang;
use App\Models\KeranjangDetail;
use App\Models\Membership;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListRekomendasiController extends Controller
{
    protected $listRekomendasi, $produk, $keranjang, $keranjangDetail, $membership, $transaksi, $transaksiDetail;

    public function __construct()
    {
        $this->listRekomendasi = new Hotel();
        $this->produk = new Produk();
        $this->keranjang = new Keranjang();
        $this->keranjangDetail = new KeranjangDetail();
        $this->membership = new Membership();
        $this->transaksi = new Transaksi();
        $this->transaksiDetail = new TransaksiDetail();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "listRekomendasi" => $this->listRekomendasi->get()
            ];

            DB::commit();

            return view("rekomendasi-hotel.index", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/rekomendasi-hotel")->with("error", $e->getMessage());
        }
    }

    public function showProduk($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "produk" => $this->produk->with("fasilitas")->where("hotel_id", $id)->get()
            ];
            $data["keranjang"] = $this->keranjang->where("users_id", Auth::user()->id)->first();

            if (!empty($data["keranjang"])) {
                $data["count"] = $this->keranjangDetail->where("keranjangId", $data["keranjang"]["id"])->count();
            }


            DB::commit();

            return view("rekomendasi-hotel.create", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function create()
    {
        try {

            DB::beginTransaction();

            DB::commit();

            return view("rekomendasi-hotel.create");
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/rekomendasi-hotel");
        }
    }

    public function createReservasi($hotelId)
    {
        try {

            DB::beginTransaction();

            $data = [
                "detail" => $this->produk->where("id", $hotelId)->first()
            ];

            DB::commit();

            return view("rekomendasi-hotel.reservasi", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function createKeranjang(Request $request, $produkId)
    {
        try {
            DB::beginTransaction();

            $countKeranjang = $this->keranjang->where("users_id", Auth::user()->id)
                ->where("status", 1)
                ->count();

            $produk = $this->produk->where("id", $produkId)->first();

            if ($countKeranjang == 0) {
                $cart = $this->keranjang->create([
                    "users_id" => Auth::user()->id,
                    "total" => 0,
                    "tanggal" => date("Y-m-d H:i:s"),
                    "status" => 1
                ]);

                $this->keranjangDetail->create([
                    "keranjangId" => $cart["id"],
                    "produk_id" => $produk["id"],
                    "qty" => $request->qty,
                    "harga" => $produk["harga"]
                ]);

                $cart->update([
                    "total" => $request->qty * $produk["harga"]
                ]);
            } else {

                $keranjangBelanja = $this->keranjang->where("users_id", Auth::user()->id)
                    ->where("status", 1)
                    ->first();

                $keranjangDetail = $this->keranjangDetail->where("keranjangId", $keranjangBelanja["id"])
                    ->where("produk_id", $produk["id"])
                    ->first();

                if ($keranjangDetail) {
                    $keranjangDetail->update([
                        "qty" => $request->qty,
                        "harga" => $produk["harga"]
                    ]);

                    $totalNew = $request->qty * $produk["harga"];

                    $sum = $this->keranjangDetail->where("keranjangId", $keranjangBelanja["id"])->get();

                    $totalKeranjangAkhir = 0;

                    foreach ($sum as $s) {
                        $totalKeranjangAkhir += $s->qty * $s->harga;
                    }

                    $keranjangBelanja->update([
                        "total" => $totalKeranjangAkhir
                    ]);
                } else {
                    $this->keranjangDetail->create([
                        "keranjangId" => $keranjangBelanja["id"],
                        "produk_id" => $produk["id"],
                        "qty" => $request->qty,
                        "harga" => $produk["harga"]
                    ]);

                    $totalNew = $request->qty * $produk["harga"];

                    $keranjangBelanja->update([
                        "total" => $keranjangBelanja["total"] + $totalNew
                    ]);
                }
            }

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function lihatKeranjang($keranjangId)
    {
        try {

            DB::beginTransaction();

            $data = [
                "keranjang" => $this->keranjang->where("id", $keranjangId)->first(),
                "keranjangDetail" => $this->keranjangDetail->where("keranjangId", $keranjangId)->get()
            ];

            DB::commit();

            return view("rekomendasi-hotel.lihat-keranjang", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function hapusKeranjangDetail($keranjangDetailId)
    {
        try {

            DB::beginTransaction();

            $cekKeranjangDetail = $this->keranjangDetail->where("id", $keranjangDetailId)->first();

            $keranjang = $this->keranjang->where("id", $cekKeranjangDetail["keranjangId"])->first();

            $total = $cekKeranjangDetail["qty"] * $cekKeranjangDetail["harga"];

            $keranjang->update([
                "total" => $keranjang["total"] - $total
            ]);

            $cekKeranjangDetail->delete();

            if ($keranjang["total"] == 0) {
                $keranjang->delete();
            }

            DB::commit();

            if (empty($keranjang)) {
                return redirect()->to("/rekomendasi-hotel")->with("success", "Keranjang Anda Kosong");
            } else {
                return back()->with("success", "Data Berhasil di Hapus");
            }
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function editData($keranjangDetailId)
    {
        try {

            DB::beginTransaction();

            $data = [
                "keranjangDetail" => $this->keranjangDetail->where("id", $keranjangDetailId)->first()
            ];

            DB::commit();

            return view("rekomendasi-hotel.edit", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function editKeranjangDetail(Request $request, $idKeranjangDetail)
    {
        try {

            DB::beginTransaction();

            $cekKeranjangDetail = $this->keranjangDetail->where("id", $idKeranjangDetail)->first();

            $produk = $this->produk->where("id", $cekKeranjangDetail->produk_id)->first();

            $keranjang = $this->keranjang->where("id", $cekKeranjangDetail["keranjangId"])
                ->where("users_id", Auth::user()->id)
                ->first();

            $cekKeranjangDetail->update([
                "qty" => $request->qty,
                "harga" => $produk->harga
            ]);

            $cart = $this->keranjang->where("users_id", Auth::user()->id)
                ->where("status", "1")
                ->first();

            $keseluruhan = $this->keranjangDetail->where("keranjangId", $cart->id)->get();

            $total = 0;

            foreach ($keseluruhan as $all) {
                $total += $all->qty * $all->harga;
            }

            $keranjang->update([
                "total" => $total
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function bayar()
    {
        try {

            DB::beginTransaction();

            $data = [
                "totalBayar" => $this->keranjang->where("users_id", Auth::user()->id)->where("status", "1")->first(),
                "point" => $this->membership->where("users_id", Auth::user()->id)->first()
            ];

            $pajak = (11 / 100) * $data["totalBayar"]["total"];
            $data["pajak"] = $data["totalBayar"]["total"] + $pajak;

            DB::commit();

            return view("rekomendasi-hotel.bayar", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function checkout(Request $request)
    {
        try {

            DB::beginTransaction();

            $keranjang = $this->keranjang->where("users_id", Auth::user()->id)
                                         ->where("status", "1")
                                         ->first();

            $keranjangDetail = $this->keranjangDetail->where("keranjangId", $keranjang->id)->get();

            $cekMembership = $this->membership->where("users_id", Auth::user()->id)->first();

            $kembali = 0;
            $bayar = 0;

            // dump($request->bayar); die();

            if ($request->reedemPoint == "ya") {
                $convert = $request->point * 100000;

                $bayar = abs($request->pajak - $convert);

                $kembali = 0;

                $cekMembership->update([
                    "point" => $cekMembership->point - $request->point
                ]);
            } else {
                $kembali = $request->bayar - $request->pajak;
            }


            $transaksi = $this->transaksi->create([
                "users_id" => $keranjang->users_id,
                "nama_users" => Auth::user()->name,
                "email_users" => Auth::user()->email,
                "total_beli" => $keranjang->total,
                "pajak" => $request->pajak,
                "total_bayar" => $request->reedemPoint == "ya" ? 0 : $request->bayar,
                "kembalian" => $kembali,
                "use_reedem" => $request->reedemPoint == "ya" ? "1" : "0",
                "point" => $request->reedemPoint == "ya" ? $request->point : 0,
                "tanggal" => date("Y-m-d H:i:s")
            ]);

            $totalEx = 0;
            $point = 0;

            foreach ($keranjangDetail as $item) {
                $this->transaksiDetail->create([
                    "transaksi_id" => $transaksi->id,
                    "produk_id" => $item->produk_id,
                    "nama_produk" => $item->produk->nama,
                    "tipe_produk" => $item->produk->tipe_produk->nama,
                    "harga" => $item->produk->harga,
                    "qty" => $item->qty
                ]);

                if ($item->produk->tipe_produk->nama == "deluxe" || $item->produk->tipe_produk->nama == "superior" || $item->produk->tipe_produk->nama == "suite") {
                    $point += $item->qty * 5;
                } else {
                    $totalEx += $item->produk->harga * $item->qty;

                    if ($totalEx % 300000 == 0) {
                        $point += 1;
                    } else {
                        $point += 0;
                    }
                }

                $this->keranjangDetail->delete();
            }

            if ($request->reedemPoint != "ya") {

                if (empty($cekMembership)) {
                    $this->membership->create([
                        "users_id" => Auth::user()->id,
                        "point" => $point,
                        "status" => 1
                    ]);
                } else {
                    $cekMembership->update([
                        "point" => $cekMembership->point + $point
                    ]);
                }
            }

            $keranjang->delete();

            DB::commit();

            return redirect()->to("/riwayat-transaksi-saya")->with("success", "Pembelian Berhasil");
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }
}
