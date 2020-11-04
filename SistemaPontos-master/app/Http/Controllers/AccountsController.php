<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\Accounts;
use App\Models\Products;
use App\Models\Requests;
use App\Models\User;

class AccountsController extends Controller{

        public function resgate($id, Accounts $account, Products $products, Requests $requests, User $user){

            $account = Accounts::findOrFail($id);

            $saldo = Accounts::all()->where('id_owner',\Auth::user()->id);
            foreach($saldo as $sal){
                $saldo = $sal->balance;
            }

            $n_products = Products::all()->where('qt_stock', '>' , 0)->pluck('name', 'id');
            
            $user = User::all();
            return view('admin.solicitacoes.resgate')->with(compact('account', 'n_products', 'user', 'saldo'));

        }

        public function saveResgate(Request $request, Requests $requests,Products $products, Accounts $account){

            $account =  Accounts::all()->where('id_owner',\Auth::user()->id);

            foreach($account as $sal){
                $saldo = $sal->balance;
            }

            if($saldo <= 0){
                \Session::flash('mensagem_sucesso','Ops, você não tem pontos suficientes!');
                return Redirect::to('/admin/solicitacoes');

            }

            $produto = $products->where('qt_stock', '>' , 0)->where('id', '=', $request->id_products)->get();

            foreach($produto as $products){

                if($saldo < $products->points_required){

                    \Session::flash('mensagem_sucesso','Ops, você não tem pontos suficientes para resgatar esse produto.');
                    return Redirect::to('/admin/solicitacoes');

                }elseif($products->points_required < $request->points){

                    \Session::flash('mensagem_sucesso','Ops, você não tem pontos suficientes para resgatar esse produto.');
                    return Redirect::to('/admin/solicitacoes');
                };
            }

            $solicitacao = [
                'points' => $request->points,
                'id_request' => \Auth::user()->id,
                'status' => 0,
                'created_at' => now(),
            ];

            Accounts::debito($request->points, $solicitacao['id_request']);

            Requests::create($solicitacao);

            \Session::flash('mensagem_sucesso','Solicitação de restate efetuada com sucesso, aguarde até 24H para liberação dos pontos.');
            return Redirect::to('/admin/solicitacoes');
        }

}
