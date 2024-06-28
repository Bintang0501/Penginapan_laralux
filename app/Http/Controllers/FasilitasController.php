<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FasilitasController extends Controller
{
    protected $produk, $fasilitas;

    public function __construct()
    {
        $this->produk = new Produk();
        $this->fasilitas = new Fasilitas();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data["produk"] = $this->produk->orderBy("name", "ASC")->get();
            $data["fasilitas"] = $this->fasilitas->orderBy("nama_fasilitas", "ASC")->get();

            DB::commit();

            return view("fasilitas.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->fasilitas->create($request->all());

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

            $data["produk"] = $this->produk->orderBy("name", "ASC")->get();
            $data['edit'] = $this->fasilitas->where("id", $id)->first();

            DB::commit();

            return view("fasilitas.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->fasilitas->where("id", $id)->update([
                "nama_fasilitas" => $request->nama_fasilitas,
                "produk_id" => $request->produk_id,
                "deskripsi" => $request->deskripsi
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

            $this->fasilitas->where("id", $id)->delete();

            DB::commit();

            return back()->with("success", "Data Berhasil di Hapus");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }
}
