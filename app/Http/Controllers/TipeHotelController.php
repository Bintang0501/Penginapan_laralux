<?php

namespace App\Http\Controllers;

use App\Models\TipeHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipeHotelController extends Controller
{
    protected $tipeHotel;

    public function __construct()
    {
        $this->tipeHotel = new TipeHotel();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data["tipeHotel"] = $this->tipeHotel->orderBy("nama", "ASC")->get();

            DB::commit();

            return view("tipe-hotel.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->tipeHotel->create($request->all());

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

            $data['edit'] = $this->tipeHotel->where("id", $id)->first();

            DB::commit();

            return view("tipe-hotel.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->tipeHotel->where("id", $id)->update([
                "nama" => $request->nama
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

            $this->tipeHotel->where("id", $id)->delete();

            DB::commit();

            return back()->with("success", "Data Berhasil di Hapus");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }
}
