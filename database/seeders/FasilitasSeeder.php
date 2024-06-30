<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    protected $fasilitas, $produk;

    public function __construct()
    {
        $this->fasilitas = new Fasilitas();
        $this->produk = new Produk();
    }

    public function run(): void
    {
        $produk1 = $this->produk->where("nama", "Kamar A")->first();
        $produk2 = $this->produk->where("nama", "Kamar B")->first();

        $this->fasilitas->create([
            "produk_id" => $produk1->id,
            "nama_fasilitas" => "Kipas",
            "deskripsi" => "Luas Ya"
        ]);

        $this->fasilitas->create([
            "produk_id" => $produk1->id,
            "nama_fasilitas" => "Makanan",
            "deskripsi" => "Lorem Ipsum Dolor Sit Amet"
        ]);

        $this->fasilitas->create([
            "produk_id" => $produk1->id,
            "nama_fasilitas" => "Laundy",
            "deskripsi" => "Luas"
        ]);

        $this->fasilitas->create([
            "produk_id" => $produk2->id,
            "nama_fasilitas" => "Laundry",
            "deskripsi" => "Luas"
        ]);
    }
}
