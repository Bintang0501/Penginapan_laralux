<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory, HasUuids;

    protected $table = "transaksi_detail";

    protected $guarded = [''];

    public $incrementing = false;

    protected $keyType = "string";

    public $primaryKey = 'id';

    public $timestamps = false;

    public function transaksi_id(){
        $this->hasMany(Transaksi::class, "transaksi_id");
    
    }
    public function produk_id(){
        $this->hasMany(Produk::class, "produk_id");
    }
}
