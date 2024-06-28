<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataku = Type::all();
        return view('type.index',compact('dataku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);   
        $request->validate(['namaTipe'=>'required']);
        $newTipe = new Type;
        $newTipe->name = $request->namaTipe;
        // $newTipe->name = $request->get("namaTipe");
        $newTipe->save();
        return redirect()->route('tipe.index')->with('status','Data berhasil masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Type::find($id);
        return view('type.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['namaTipe'=>'required']);
        $newTipe = Type::find($id);
        $newTipe->name = $request->namaTipe;
        // $newTipe->name = $request->get("namaTipe");
        $newTipe->save();
        return redirect()->route('tipe.index')->with('status','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=Auth::user();
        $this->authorize('delete-permission',$user);
        
        try {
            $hotel = Type::find($id);
            $hotel->delete();

            return redirect()->route('tipe.index')
                ->with('status','Data berhasil dihapus');

        } catch (\Throwable $th) {
            $msg="Tidak bisa dihapus karena data sudah digunakan";
            return redirect()->route('tipe.index')
                ->with('status',$msg);
        }
    }
}
