<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\TipeHotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    protected $hotel, $tipeHotel;

    public function __construct()
    {
        $this->hotel = new Hotel();
        $this->tipeHotel = new TipeHotel();
    }

    public function run(): void
    {
        $tipeHotel1 = $this->tipeHotel->where('nama', 'City')->first();
        $tipeHotel2 = $this->tipeHotel->where('nama', 'Residential')->first();

        $this->hotel->create([
            "tipe_hotel_id" => $tipeHotel1,
            "nama" => "Bentani",
            "alamat" => "Gunungjati",
            "nomor_telepon" => "85324237299",
            "email" => "bentani@gmail.com"
        ]);

        $this->hotel->create([
            "tipe_hotel_id" => $tipeHotel2,
            "nama" => "Prima",
            "alamat" => "Bandung",
            "nomor_telepon" => "85324237129",
            "email" => "prima@gmail.com"
        ]);
    }
}
