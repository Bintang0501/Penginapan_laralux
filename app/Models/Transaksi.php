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

    public function user_id(){
        $this->hasMany(User::class, "uses_id");
    }
}
