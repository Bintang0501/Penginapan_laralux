<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory, HasUuids;

    protected $table = "pembeli";

    protected $guarded = [''];

    public $timestamps = false;

    public $incrementing = false;

    protected $keyType = "string";
}
