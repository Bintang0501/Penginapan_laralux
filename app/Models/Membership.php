<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory, HasUuids;

    protected $table = "membership";

    protected $guarded = [''];

    public $incrementing = false;

    protected $keyType = "string";

    public $primaryKey = 'id';

    public $timestamps = false;
}
