<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index()
    {
        try {

            DB::beginTransaction();

            DB::commit();

            return view("riwayat-transaksi-saya.index");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->to("/staff")->with("error", $e->getMessage());
        }
    }
}
