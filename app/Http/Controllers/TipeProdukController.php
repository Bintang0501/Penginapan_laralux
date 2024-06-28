<?php

namespace App\Http\Controllers;

use App\Models\TipeProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipeProdukController extends Controller
{
    protected $tipeProduk;

    public function __construct()
    {
        $this->tipeProduk = new TipeProduk();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data["tipeProduk"] = $this->tipeProduk->orderBy("name", "ASC")->get();

            DB::commit();

            return view("tipe-produk.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->tipeProduk->create($request->all());

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

            $data['edit'] = $this->tipeProduk->where("id", $id)->first();

            DB::commit();

            return view("tipe-produk.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->tipeProduk->where("id", $id)->update([
                "name" => $request->name
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

            $this->tipeProduk->where("id", $id)->delete();

            DB::commit();

            return back()->with("success", "Data Berhasil di Hapus");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }
}
