<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transactions extends Model{

    protected $fillable = [
        'type',
        'points',
        'has_adesion',
        'id_plan',
        'id_receive',
        'id_send',
        'plate',
        'obs',
        'status'
    ];

    public function listAll(){
        return DB::table('transactions')
        ->join('plans', 'id_plan', 'plans.id')
        ->join('users', 'id_receive', 'users.id')
        ->selectRaw('plans.name as plan, users.name as receive, transactions.created_at, transactions.*')
        ->get();
    }
}
