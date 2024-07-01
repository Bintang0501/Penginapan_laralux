<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Membership;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    protected $transaksi, $membership, $hotel;

    public function __construct()
    {
        $this->transaksi = new Transaksi();
        $this->membership = new Membership();
        $this->hotel = new Hotel();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "transaksi" => $this->transaksi->get()
            ];

            DB::commit();

            return view("laporan.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function filter(Request $request)
    {
        try {

            DB::beginTransaction();

            $data = [];

            if ($request->filter == "keseluruhan") {

                $data["filterBy"] = $this->transaksi->orderBy("tanggal", "DESC")->get();

            } else if ($request->filter == "hotelReservasi") {

                $data["filterBy"] = $this->hotel->select("hotel.id", "hotel.nama", "hotel.alamat", "hotel.nomor_telepon", "hotel.email")
                    ->withCount("transaksiDetail")
                    ->take(3)
                    ->get();

            } else if ($request->filter == "pelangganPembelianTerbanyak") {

                $data['filterBy'] = $this->transaksi->select('users_id',
                DB::raw('MAX(nama_users) as nama_users'),
                DB::raw('MAX(email_users) as email_users'),
                DB::raw('SUM(total_beli) as total_beli'))
            ->groupBy('users_id')
            ->orderByDesc('total_beli')
            ->take(3)
            ->get();

            } else if ($request->filter == "pelangganMembershipTerbanyak") {

                $data['filterBy'] = $this->membership->where("status", "1")->orderBy("point", "DESC")->get();
            }

            session(["data" => $data['filterBy']]);
            session(["filter" => $request->filter]);

            DB::commit();

            return back()->with("success", "Data Telah di Filter")->with($data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function hapusFilter()
    {
        session()->forget("filter");

        return back()->with("success", "Sesi Telah Dihapus");
    }
}
