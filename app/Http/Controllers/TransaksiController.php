<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    protected $transaksi, $produk, $membership;

    public function __construct()
    {
        $this->transaksi = new Transaksi();
        $this->produk = new Produk();
        $this->membership = new Membership();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data["transaksi"] = $this->transaksi->all();

            DB::commit();

            return view("transaksi.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $data = $request->all();

            $user_id = $request->users_id;

            $membership = $this->membership->where('users_id', $user_id)->first();

            if (!$membership) {
                // Buat membership baru jika belum ada
                $membership = Membership::create([
                    'users_id' => $user_id,
                    'poin' => 0, // Atur poin awal sesuai kebutuhan
                ]);
            }

            // Tambahkan poin ke membership yang ada atau baru dibuat
            $pointsToAdd = 10; // Atur poin yang akan ditambahkan sesuai dengan aturan Anda
            $membership->poin += $pointsToAdd;
            $membership->save();

            $this->transaksi->create($data);

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

            $data['edit'] = $this->transaksi->where("id", $id)->first();

            DB::commit();

            return view("transaksi.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->transaksi->where("id", $id)->update([
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

            $this->transaksi->where("id", $id)->delete();

            DB::commit();

            return back()->with("success", "Data Berhasil di Hapus");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }
}
