<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::all();
        // $hotels = DB::table('hotel123')->get();
        return view('hotel.index', ['dataku' => $hotels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipes = Type::all();
        return view('hotel.create',compact('tipes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $newHotel = new Hotel;
        $newHotel->name = $request->namaHotel;
        $newHotel->address = $request->address;
        $newHotel->city = $request->city;
        $newHotel->type_id = $request->type;
        // $newTipe->name = $request->get("namaTipe");
        $newHotel->save();
        return redirect()->route('hotel.index')->with('status','Data berhasil masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Hotel::find($id);
        $tipes = Type::all();
        return view('hotel.edit',compact('data','tipes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=Auth::user();
        $this->authorize('delete-permission',$user);

        try {
            $hotel = Hotel::find($id);
            $hotel->delete();

            return redirect()->route('hotel.index')
                ->with('status','Data berhasil dihapus');

        } catch (\Throwable $th) {
            $msg="Tidak bisa dihapus karena data sudah digunakan";
            return redirect()->route('hotel.index')
                ->with('status',$msg);
        }
        
    }
}
