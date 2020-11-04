<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use DB;
use App\Models\User;
use App\Models\Accounts;

class ApiRegisterController extends Controller {

    use RegistersUsers;

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'telephone' => ['required'],
        ]);
    }

    public function register(Request $request) {

        $errors = $this->validator($request->all())->errors();

        if(count($errors)) {
            return response(['errors' => $errors], 401);
        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return response(['user' => $user]);
    }

    protected function create(array $data){

        $teste = User::create([
            'type' => 1,
            'name' => $data['name'],
            'function' => $data['function'],
            'location_work' => $data['location_work'],
            'telephone' => $data['telephone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Accounts::create([
            'balance' => 0,
            'id_owner' => $teste->id
        ]);

        return $teste;
    }

}
