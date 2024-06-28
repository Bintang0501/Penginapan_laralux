<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\TipeProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    protected $produk, $tipeProduk;

    public function __construct()
    {
        $this->produk = new Produk();
        $this->tipeProduk = new TipeProduk();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data["produk"] = $this->produk->orderBy("name", "ASC")->get();
            $data["tipeProduk"] = $this->tipeProduk->orderBy("name", "ASC")->get();

            DB::commit();

            return view("produk.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->produk->create($request->all());

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data['edit'] = $this->produk->where("id", $id)->first();
            $data["tipeProduk"] = $this->tipeProduk->orderBy("name", "ASC")->get();

            DB::commit();

            return view("produk.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->produk->where("id", $id)->update([
                "name" => $request->name,
                "tipe_produk_id" => $request->tipe_produk_id,
                "harga" => $request->harga
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $this->produk->where("id", $id)->delete();

            DB::commit();

            return back()->with("success", "Data Berhasil di Hapus");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }
}
