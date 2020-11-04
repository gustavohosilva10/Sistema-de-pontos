<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adesions extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'created_at'
    ];
}
