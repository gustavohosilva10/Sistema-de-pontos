<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indications extends Model {

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'type_vehicle',
        'manufacturer',
        'model',
        'id_responsible',
        'status',
    ];

}
