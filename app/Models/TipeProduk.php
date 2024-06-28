<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeProduk extends Model
{
    use HasFactory, HasUuids;

    protected $table = "tipe_produk";

    protected $guarded = [''];

    public $incrementing = false;

    protected $keyType = "string";

    public $primaryKey = 'id';

    public $timestamps = false;

    public function produk()
    {
        $this->hasMany(Produk::class, 'tipe_produk_id');
    }
}
