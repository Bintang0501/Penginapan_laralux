<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Keranjang;
use App\Models\KeranjangDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListRekomendasiController extends Controller
{
    protected $listRekomendasi, $produk, $keranjang, $keranjangDetail;

    public function __construct()
    {
        $this->listRekomendasi = new Hotel();
        $this->produk = new Produk();
        $this->keranjang = new Keranjang();
        $this->keranjangDetail = new KeranjangDetail();
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

                $detailCart = $this->keranjangDetail->create([
                    "keranjangId" => $cart["id"],
                    "produk_id" => $produk["id"],
                    "qty" => $request->qty,
                    "harga" => $produk["harga"]
                ]);

                $cart->update([
                    "total" => $produk["harga"]
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
                        "harga" => $keranjangDetail['harga'] + $produk["harga"]
                    ]);

                    $keranjangBelanja->update([
                        "total" => $keranjangBelanja["total"] + $produk["harga"]
                    ]);
                } else {
                    $this->keranjangDetail->create([
                        "keranjangId" => $keranjangBelanja["id"],
                        "produk_id" => $produk["id"],
                        "qty" => 1,
                        "harga" => $produk["harga"]
                    ]);

                    $keranjangBelanja->update([
                        "total" => $keranjangBelanja["total"] + $produk["harga"]
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

            $keranjang->update([
                "total" => $keranjang["total"] - $cekKeranjangDetail["harga"]
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
}
