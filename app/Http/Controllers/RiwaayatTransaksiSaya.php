<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCPDF;

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

    public function show($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "detail" => $this->transaksi->where("id", $id)->first()
            ];

            DB::commit();

            return view("riwayat-transaksi-saya.detail", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function downloadPDF($id)
    {
        $transaksi = $this->transaksi->findOrFail($id);

        $html = view('riwayat-transaksi-saya.pdf', compact('transaksi'))->render();

        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        return response()->streamDownload(function () use ($pdf) {
            $pdf->Output('nota_transaksi.pdf', 'I');
        }, 'nota_transaksi.pdf');
    }
}
