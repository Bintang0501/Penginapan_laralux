<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListRekomendasiController extends Controller
{
    protected $listRekomendasi, $produk;

    public function __construct()
    {
        $this->listRekomendasi = new Hotel();
        $this->produk = new Produk();
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

    public function search($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "rekomendasi" => $this->listRekomendasi->where("id", $id)->first(),
                "produk" => $this->produk->where("hotel_id", $id)->get()
            ];

            DB::commit();

            return view("rekomendasi-hotel.create", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
