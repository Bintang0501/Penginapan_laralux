<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    protected $hotel;

    public function __construct()
    {
        $this->hotel = new Hotel();
    }

    public function run(): void
    {
        $this->hotel->create([
            "tipe_hotel_id" => 1,
            "nama" => "Bentani",
            "alamat" => "Gunungjati",
            "nomor_telepon" => "85324237299",
            "email" => "bentani@gmail.com"
        ]);

        $this->hotel->create([
            "tipe_hotel_id" => 2,
            "nama" => "Prima",
            "alamat" => "Bandung",
            "nomor_telepon" => "85324237129",
            "email" => "prima@gmail.com"
        ]);
    }
}
