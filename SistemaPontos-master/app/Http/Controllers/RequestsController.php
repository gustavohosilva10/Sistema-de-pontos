<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Accounts;
use App\Models\Requests;

use DataTables;
use Redirect;
use DB;

class RequestsController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(User $user, Accounts $account){

        $user = User::all();

        $id_auth = \Auth::user()->id;
        $accounts = Accounts::all()->where('id_owner',$id_auth);

        foreach ($accounts as $account) {
            $account = $account;
        }

        return view('admin.solicitacoes.index')->with(compact('account', $account, 'user', $user));

    }

    public function alterar($id){

        return view('admin.solicitacoes.alterar')->with(compact('id'));

    }

    public function salvar($id,Request $request){

        $requisicao = Requests::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'required',
        ]);

        DB::table('requests')
        ->where('id', $id)
        ->update(['status' => $request->status]);

        if($request->status == 1){

            \Session::flash('mensagem_sucesso','A solicitação de resgate foi ATENDIDA com sucesso.');
        }elseif($request->status == 2){

            Accounts::credito($requisicao->points, $requisicao->id_request);
            \Session::flash('mensagem_sucesso','A solicitação de resgate foi CANCELADA com sucesso.');
        }

        return Redirect::to('/admin/solicitacoes');
    }

    public function datables(Requests $requests){

        if(\Auth::user()->type == 0){

            $requests = Requests::listAll();
            return DataTables::of($requests)->make(true);

        }elseif(\Auth::user()->type == 1){
            $requests =  Requests::listAll()->where('id_request',\Auth::user()->id);
            return DataTables::of($requests)->make(true);
        }


    }

}
