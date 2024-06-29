<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory, HasUuids;

    protected $table = "produk";

    protected $guarded = [''];

    public $incrementing = false;

    protected $keyType = "string";

    public $primaryKey = 'id';

    public $timestamps = false;

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, "id");
    }

    public function tipe_produk()
    {
        return $this->belongsTo(TipeProduk::class, "tipe_produk_id");
    }

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, "produk_id");
    }
}
