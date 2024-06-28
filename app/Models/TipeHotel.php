<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeHotel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tipe_hotel';
    
    protected $guarded = [''];

    public $incrementing = false;

    protected $keyType = "string";

    public $primaryKey = 'id';

    public $timestamps = false;

    public function hotel()
    {
        return $this->hasMany(Hotel::class, "tipe_hotel_id");
    }
}
