<?php

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->users = new User();
    }

    public function login()
    {
        try {

            DB::beginTransaction();

            DB::commit();

            return view("authorization.login");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function postLogin(Request $request)
    {
        try {

            $cek = $this->users->where("email", $request->email)->first();

            if ($cek) {
                $cekPassword = Hash::check($request->password, $cek->password);

                if ($cekPassword) {
                    if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
                        $request->session()->regenerate();

                        return redirect()->to("/dashboard")->with("success", "Anda Berhasil Login");
                    }
                } else {
                    return back()->with("error", "Password Anda Salah")->withInput();
                }
            } else {
                return back()->with("error", "Data Tidak Ditemukan")->withInput();
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function logout()
    {
        try {

            DB::beginTransaction();

            Auth::logout();

            DB::commit();

            return redirect()->to("/authorization/login");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/dashboard");
        }
    }
}
