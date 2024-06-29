<?php

namespace Database\Seeders;

use App\Models\TipeProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeProdukSeeder extends Seeder
{
    protected $tipeProduk;

    public function __construct()
    {
        $this->tipeProduk = new TipeProduk();
    }

    public function run(): void
    {
        $this->tipeProduk->create([
            "nama" => "Deluxe"
        ]);

        $this->tipeProduk->create([
            "nama" => "Standar"
        ]);
    }
}
