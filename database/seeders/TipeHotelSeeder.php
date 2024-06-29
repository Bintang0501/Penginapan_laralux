<?php

namespace Database\Seeders;

use App\Models\TipeHotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeHotelSeeder extends Seeder
{
    protected $tipeHotel;

    public function __construct()
    {
        $this->tipeHotel = new TipeHotel();
    }

    public function run(): void
    {
        $this->tipeHotel->create([
            "nama" => "City"
        ]);

        $this->tipeHotel->create([
            "nama" => "Residential"
        ]);
    }
}
