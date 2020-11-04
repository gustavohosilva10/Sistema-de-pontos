<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Accounts extends Model{

    protected $fillable = [
        'balance',
        'id_consult',
        'id_owner',
        'created_at',
    ];

    public $timestamps = false;

    public static function credito($valor, $destino){

        return DB::table('accounts')
        ->where('id_owner', $destino)
        ->increment('balance', $valor);
    }

    public static function debito($valor, $destino){

        return DB::table('accounts')
        ->where('id_owner', $destino)
        ->decrement('balance', $valor);
    }

    public static function saldo($id){

        return DB::table('accounts')
        ->selectRaw('*')
        ->where('id_owner', $id)
        ->get();
    }


}
