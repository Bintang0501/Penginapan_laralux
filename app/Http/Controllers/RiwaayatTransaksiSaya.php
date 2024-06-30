<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwaayatTransaksiSaya extends Controller
{
    protected $transaksi;

    public function __construct()
    {
        $this->transaksi = new Transaksi();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "transaksi" => $this->transaksi->where("users_id", Auth::user()->id)->get()
            ];

            DB::commit();

            return view("riwayat-transaksi-saya.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }
}
