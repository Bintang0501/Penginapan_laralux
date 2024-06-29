<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Produk;
use App\Models\TipeProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    protected $produk, $hotel, $tipeProduk;

    public function __construct()
    {
        $this->produk = new Produk();
        $this->hotel = new Hotel();
        $this->tipeProduk = new TipeProduk();
    }

    public function run(): void
    {
        $hotel = $this->hotel->first();
        $tipeProduk = $this->tipeProduk->where("nama", 'Deluxe')->first();
        $tipeProduk2 = $this->tipeProduk->where("nama", 'Standar')->first();

        $this->produk->create([
            "hotel_id" => $hotel->id,
            "tipe_produk_id" => $tipeProduk->id,
            "nama" => "Kamar A",
            "harga" => "100000",
            "deskripsi" => "Hanya Kasur Ukuran 3x3",
        ]);

        $this->produk->create([
            "hotel_id" => $hotel->id,
            "tipe_produk_id" => $tipeProduk2->id,
            "nama" => "Kamar A",
            "harga" => "100000",
            "deskripsi" => "Fasilitas AC, Kasur",
        ]);
    }
}
