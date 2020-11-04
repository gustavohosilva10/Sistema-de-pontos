<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Accounts;
use App\Models\Transactions;
use App\Models\Requests;

class HomeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Accounts $account, Transactions $transactions){

        $type = \Auth::user()->type;
        $id_auth = \Auth::user()->id;

        if($type === 0){

            // administrador
            $alltransactions = Transactions::all()->where('status', 1);
            $saldo = 0;
            if(!empty($alltransactions)){
                foreach ($alltransactions as $one){
                    $saldo += $one->points;
                }
            }else {
                $saldo = 0;
            }

            $debito = Transactions::all()->where('type', 0);
            $qt_debito = 0;
            if(!empty($debito)){
                foreach ($debito as $debit){
                    $qt_debito += $debit->points;
                }
            }else {
                $qt_debito = 0;
            }

            $credito = Transactions::all()->where('type', 1)->where('status', 1);
            $qt_credito = 0;
            if(!empty($credito)){
                foreach ($credito as $credit){
                    $qt_credito += $credit->points;
                }
            }else {
                $qt_credito = 0;
            }

            $resgates = Requests::all();
            $qt_resgates = 0;

            foreach ($resgates as $resg){
                if($resg->status == 1){

                    $qt_resgates += $resg->points;

                }
            }

            $s_pendente = Transactions::all()->where('status', 0);
            $c_pendente = 0;

            if(!empty($s_pendente)){

                foreach ($s_pendente as $pendente){
                    $c_pendente += $pendente->points;
                }
            }else {
                $c_pendente = 0;
            }

            $saldo = ($qt_credito - $qt_debito - $qt_resgates);

            $user = User::all();
            return view('admin.index')->with(compact('user','qt_credito','qt_debito', 'qt_resgates','saldo','c_pendente'));

        }else{

            // consultor
            $saldo = Accounts::all()->where('id_owner',$id_auth);
            
            if(!empty($saldo)){
                foreach($saldo as $sal){
                    $saldo = $sal->balance;
                }
            }
            else{
                $saldo = 0;
            }
            
            $debito = Transactions::where('type', 0)->get();
            $qt_debito = 0;

            if(!empty($debito)){
                foreach ($debito as $debit){

                    if($debit->id_receive === \Auth::user()->id){
                        $qt_debito += $debit->points;
                    }
                }
            }else {
                $qt_debito = 0;
            }

            $credito = Transactions::where('id_receive', \Auth::user()->id)
            ->where('type', 1)
            ->where('status', 1)
            ->get();

           
            $qt_credito = 0;
            if(!empty($credito)){
                foreach ($credito as $credit){

                    if($credit->id_receive === \Auth::user()->id){
                        $qt_credito += $credit->points;
                    }
                }
            }else {
                $qt_credito = 0;
            }

            $resgates = Requests::all();
            $qt_resgates = 0;

            foreach ($resgates as $resg){

                if($resg->status == 1){

                    if($resg->id_request == \Auth::user()->id){
                        $qt_resgates += $resg->points;
                    }

                }

            }
            
 
            $s_pendente = Transactions::where('status', 0)
                ->where('id_receive', \Auth::user()->id)
                ->get();
            $c_pendente = 0;

            if(!empty($s_pendente)){

                foreach ($s_pendente as $pendente){
                    $c_pendente += $pendente->points;
                }
            }else {
                $c_pendente = 0;
            }

            $t_saldo = ($qt_credito - $qt_debito - $qt_resgates);
            
            $saldo = Accounts::where('id_owner',$id_auth)->first();
              
            $saldo->balance = $t_saldo;
            $saldo->save();
            // dd($saldo->balance);
            
            $user = User::all();
            return view('admin.index')->with(compact('user','qt_credito','qt_debito', 'qt_resgates','t_saldo','c_pendente'));

        }

    }
}
