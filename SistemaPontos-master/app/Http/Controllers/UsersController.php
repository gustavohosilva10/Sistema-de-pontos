<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Accounts;
use Redirect;
use Hash;
use DataTables;
use DB;

class UsersController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.usuarios.index');
    }

    public function datables(User $user){
        $user = User::all();
        return DataTables::of($user)->make(true);
    }

    public function create(){
        return view('admin.usuarios.formulario');
    }

    public function update($id, User $user){
        $user = User::findOrFail($id);
        return view('admin.usuarios.formulario')->with('user', $user);
    }

    public function savecreate(Accounts $account, Request $request){

        $validatedData = $request->validate([
            "type" => 'required',
            "name" => 'required',
            "email" => 'required|string|email|max:255|unique:users',
            "telephone" => 'required',
            "function" => 'required',
            "location_work" => 'required',
            "cpf" => 'required',
            "bank" => 'required',
            "agency" => 'required',
            "account" => 'required',
            "account_type" => 'required',
            "password" => 'required|min:6|confirmed',
        ]);

        $request->merge(['password' => Hash::make($request->password)]);

        User::create($request->all());

        $lastID = DB::getPdo()->lastInsertId();
        Accounts::create([
            'balance' => 0,
            'id_owner' => $lastID
        ]);

        DB::getPdo()->lastInsertId();
        \Session::flash('mensagem_sucesso','O consultor '.$request->name.' foi CRIADO com sucesso.');
        return Redirect::to('/admin/usuarios');

    }

    public function saveupdate($id, Request $request){


        $validatedData = $request->validate([
            'type' => 'required',
            'name' => 'required',
            'telephone' => 'required',
            'email' => 'required|string|email|max:255',
        ]);

        $usuarios = User::findOrFail($id);
        $usuarios->update($request->all());

        \Session::flash('mensagem_sucesso','O consultor '.$request->name.' foi ATUALIZADO com sucesso.');
        return Redirect::to('/admin/usuarios');

    }

    public function delete($id){

        $user = User::findOrFail($id);
        return  response()->json($user->delete());
    }
}