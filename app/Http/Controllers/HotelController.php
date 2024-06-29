<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\TipeHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    protected $hotel;
    protected $tipe_hotel;

    public function __construct()
    {
        $this->hotel = new Hotel();
        $this->tipe_hotel = new TipeHotel();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data["hotel"] = $this->hotel->with("tipe_hotel")->orderBy("nama", "ASC")->get();

            $data["tipe_hotel"] = $this->tipe_hotel->all();

            DB::commit();

            return view("hotel.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->hotel->create($request->all());

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

            $data['edit'] = $this->hotel->where("id", $id)->first();

            $data["tipe_hotel"] = $this->tipe_hotel->all();

            DB::commit();

            return view("hotel.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->hotel->where("id", $id)->update([
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

            $this->hotel->where("id", $id)->delete();

            DB::commit();

            return back()->with("success", "Data Berhasil di Hapus");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }
}
