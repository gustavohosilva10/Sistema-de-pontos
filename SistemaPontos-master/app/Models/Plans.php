<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model{

    protected $fillable = [
        'name',
        'points',
        'has_adesion',
        'id_adesion',
    ];

    public static function complete()
    {
        return Self::with('withAdesions');
    }

    public function withAdesions()
    {
        return $this->hasMany('App\Models\Adesions', 'id', 'id_adesion');
    }
}
