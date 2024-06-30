<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory, HasUuids;

    protected $table = "keranjang";

    protected $guarded = [''];

    public $timestamps = false;

    public $incrementing = false;

    public $primaryKey = "id";

    protected $keyType = "string";
}
