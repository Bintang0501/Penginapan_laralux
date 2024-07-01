<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    protected $users, $member;

    public function __construct()
    {
        $this->users = new User();
        $this->member = new Pembeli();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "member" => $this->member->get()
            ];

            DB::commit();

            return view("member.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $users = $this->users->create([
                "name" => $request->nama,
                "email" => $request->email,
                "password" => bcrypt("password"),
                "role" => "PEMBELI"
            ]);

            $this->member->create([
                "no_ktp" => $request->no_ktp,
                "user_id" => $users->id,
                "jenis_kelamin" => $request->jenis_kelamin,
                "alamat" => $request->alamat
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "edit" => $this->member->where("id", $id)->first()
            ];

            DB::commit();

            return view("member.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $member = $this->member->where("id", $id)->first();

            $member->update([
                "no_ktp" => $request->no_ktp,
                "jenis_kelamin" => $request->jenis_kelamin,
                "alamat" => $request->alamat
            ]);

            $users = $this->users->where("id", $member->user_id)->first();

            $users->update([
                "name" => $request->nama,
                "email" => $request->email,
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard")->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $member = $this->member->where("id", $id)->first();

            $this->users->where("id", $member->user_id)->delete();

            $member->delete();

            DB::commit();

            return back()->with("success", "Data Berhasil di Hapus");

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
