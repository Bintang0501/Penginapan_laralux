<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCPDF;

class RiwaayatTransaksiSaya extends Controller
{
    protected $transaksi, $detail_transaksi;

    public function __construct()
    {
        $this->transaksi = new Transaksi();
        $this->detail_transaksi = new TransaksiDetail();
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
        $data = [
            "transaksi" => $this->transaksi->where("id", $id)->first(),
            "detail" => $this->detail_transaksi->all()
        ];

        // Render HTML template to string
        $html = view('riwayat-transaksi-saya.pdf', compact('data'))->render();

        // Create Dompdf instance
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (optional settings)
        $dompdf->render();

        // Output PDF to browser
        // ['Attachment' => 0] jika tidak ingin langsung download
        return $dompdf->stream('nota_transaksi.pdf', ['Attachment' => 0]);
    }
}
