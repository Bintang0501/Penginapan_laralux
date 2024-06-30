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
            "nama" => "deluxe"
        ]);

        $this->tipeProduk->create([
            "nama" => "superior"
        ]);

        $this->tipeProduk->create([
            "nama" => "suite"
        ]);

        $this->tipeProduk->create([
            "nama" => "standard"
        ]);
    }
}
