<?php

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Models\Pembeli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    protected $users, $pembeli;

    public function __construct()
    {
        $this->users = new  User();
        $this->pembeli = new Pembeli();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            DB::commit();

            return view("authorization.register");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/authorization/login");
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $users = $this->users->create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "role" => "PEMBELI",
            ]);

            $this->pembeli->create([
                "no_ktp" => $request->no_ktp,
                "user_id" => $users->id,
                "jenis_kelamin" => $request->jenis_kelamin,
                "alamat" => $request->alamat
            ]);

            DB::commit();

            return redirect()->to("/authorization/login")->with("success", "Anda Berhasil Login");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }
}
