<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use DB;
use App\Models\Accounts;

class RegisterController extends Controller{
    use RegistersUsers;

    protected $redirectTo = '/admin';

    public function __construct(){
        $this->middleware('guest');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'telephone' => ['required'],
        ]);
    }

    protected function create(array $data){

        $teste = User::create([
            'type' => 1,
            "name" => $data["name"],
            "email" => $data["email"],
            "telephone" => $data["telephone"],
            "function" => $data["function"],
            "location_work" => $data["location_work"],
            "cpf" => $data["cpf"],
            "bank" => $data["bank"],
            "agency" => $data["agency"],
            "account" => $data["account"],
            "account_type" => $data["account_type"],
            "password" =>  Hash::make($data["password"]),
        ]);
        
        $lastID = DB::getPdo()->lastInsertId();
        Accounts::create([
            'balance' => 0,
            'id_owner' => $lastID
        ]);

        return $teste;
    }

}
