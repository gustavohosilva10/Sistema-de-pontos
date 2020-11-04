<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plans;
use App\Models\User;
use App\Models\Transactions;
use App\Models\Accounts;

use DB;

use DataTables;
use Redirect;

class TransactionsController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    private function formatMoeda($get_valor) {

        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor);

        return $valor;

    }

    public function index(User $user, Accounts $account){

        $user = User::all();
        $id_auth = \Auth::user()->id;
        $accounts = Accounts::all()->where('id_owner',$id_auth);

        $saldo = Accounts::all()->where('id_owner',\Auth::user()->id);
        foreach($saldo as $sal){
            $saldo = $sal->balance;
        }

        foreach ($accounts as $account) {
            $account = $account;
        }

        return view('admin.transacoes.index')->with(compact('account', $account, 'user', $user,'saldo'));

    }

    public function datables(Transactions $transactions){

        if(\Auth::user()->type == 0){

            $transactions = $transactions->listAll();
            return DataTables::of($transactions)->make(true);

        }elseif(\Auth::user()->type == 1){
            $transactions = $transactions->listAll()->where('id_receive',\Auth::user()->id);
            return DataTables::of($transactions)->make(true);
        }

    }

    public function create(Plans $plans, User $user){
        $plan = Plans::pluck('name','id');
        $user = User::all()->where('type', 1)->pluck('name','id');
        return view('admin.transacoes.formulario')->with(compact('plan', $plan,'user', $user));
    }

    public function savecreate(Accounts $account, Plans $plans, Request $request){

        $validatedData = $request->validate([
            'type' => 'required',
            'id_plan' => 'required',
            'id_receive' => 'required',
            'plate' => 'required|string',
        ]);

        if($request->status){

            switch ($request->status){

                case 1:
                    switch($request->type){
                        case 1 :
                            // credito
                            $plan = Plans::findOrFail($request->id_plan);

                            // registra transacao
                            $request->merge(['points' => $this->formatMoeda($plan->points) ]);
                            $request->merge(['id_send' => \Auth::user()->id ]);
                            $request->merge(['status' => 0 ]);
                            Transactions::create($request->all());

                            \Session::flash('mensagem_sucesso','Os pontos estão AGUARDANDO APROVAÇÃO.');
                            return Redirect::to('/admin/transacoes');
                        break;

                    }
                break;
            }
        }else{
            switch($request->type){
                case 1 :
                    // credito
                    $plan = Plans::findOrFail($request->id_plan);
                    Accounts::credito($this->formatMoeda($plan->points), $request->id_receive);

                    // registra transacao
                    $request->merge(['points' => $this->formatMoeda($plan->points) ]);
                    $request->merge(['id_send' => \Auth::user()->id ]);
                    $request->merge(['status' => 1 ]);
                    Transactions::create($request->all());

                    \Session::flash('mensagem_sucesso','Os pontos foram CREDITADOS COM SUCESSO!');
                    return Redirect::to('/admin/transacoes');

                break;

                case 0 :
                    // debito
                    $plan = Plans::findOrFail($request->id_plan);
                    Accounts::debito($this->formatMoeda($plan->points), $request->id_receive);

                    // registra transacao
                    $request->merge(['points' => $plan->points ]);
                    $request->merge(['id_send' => \Auth::user()->id ]);
                    $request->merge(['status' => 1 ]);

                    Transactions::create($request->all());

                    \Session::flash('mensagem_sucesso','Os pontos foram DEBITADOS COM SUCESSO!.');
                    return Redirect::to('/admin/transacoes');
                break;
            }
        }
    }
     
    function FormStatus($plate, $id_plan, $id, $id_receive, $saldo){
        $transactions = Transactions::findOrFail($id);
        return view('admin.transacoes.status')->with(compact('plate','saldo', 'transactions', 'id_plan', 'id','id_receive'));

    }

    function saveStatus(Request $request){

        $validatedData = $request->validate([
            'obs' => 'required',
            'status' => 'required',
        ]);

        switch ($request->status){

            case 1:
                DB::table('transactions')
                ->where('id', $request->id)
                ->update(['status' => $request->status]);

                $plan = Plans::findOrFail($request->id_plan);
                Accounts::credito($plan->points, $request->id_receive);

                \Session::flash('mensagem_sucesso','Os pontos foram APROVADOS COM SUCESSO!');
                return Redirect::to('/admin/transacoes');
            break;

            case 2:

                $plan = Plans::findOrFail($request->id_plan);

                DB::table('transactions')
                ->where('id', $request->id)
                ->delete();

                // crédito dos pontos
                Accounts::credito($plan->points, $request->id_receive);
                $request->merge(['points' => $plan->points ]);
                $request->merge(['id_send' => \Auth::user()->id ]);
                $request->merge(['type' => 0 ]);
                $request->merge(['status' => 1 ]);
                $request->merge(['plate' => $request->plate ]);
                Transactions::create($request->all());

                // debito dos pontos
                Accounts::debito($plan->points, $request->id_receive);
                $request->merge(['points' => $plan->points ]);
                $request->merge(['id_send' => \Auth::user()->id ]);
                $request->merge(['type' => 1]);
                $request->merge(['status' => 1 ]);
                $request->merge(['plate' => $request->plate ]);
                Transactions::create($request->all());

                \Session::flash('mensagem_sucesso','A transação foi ANULADOS COM SUCESSO!');
                return Redirect::to('/admin/transacoes');

            break;


        }


    }

}
