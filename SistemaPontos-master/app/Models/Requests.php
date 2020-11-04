<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Requests extends Model{

    protected $fillable = [
        'type',
        'points',
        'id_request',
        'status',
    ];

    public static function listAll(){
        return DB::table('requests')
        ->join('users', 'requests.id_request', 'users.id')
        ->selectRaw('requests.*,users.name as receive')
        ->get();
    }

}
