<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'hotel';
    
    protected $guarded = [''];

    public $incrementing = false;

    protected $keyType = "string";

    public $primaryKey = 'id';

    public $timestamps = false;

    public function tipe_hotel()
    {
        return $this->belongsTo(TipeHotel::class, "tipe_hotel_id");
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'hotel_id');
    }
}
