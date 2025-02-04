<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory, HasUuids;

    protected $table = "transaksi";

    protected $guarded = [''];

    public $incrementing = false;

    protected $keyType = "string";

    public $primaryKey = 'id';

    public $timestamps = false;

    public function users_id(){
        $this->hasMany(User::class, "users_id");
    }

    public function produk_id(){
        $this->hasMany(Produk::class, "produk_id");
    }
    
    public function transaksi_id(){
        $this->belongsTo(TransaksiDetail::class, "transaksi_id");
    }
}
