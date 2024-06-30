<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function dashboard()
    {
        try {

            DB::beginTransaction();

            DB::commit();

            return view("dashboard");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/authorization/login");
        }
    }
}
