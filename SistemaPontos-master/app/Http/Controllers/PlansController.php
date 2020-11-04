<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Plans;
use App\Models\Transactions;
use App\Models\Adesions;
use Redirect;

class PlansController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    private function formatMoeda($get_valor) {

        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor);

        return $valor;

    }

    public function index(){
        return view('admin.planos.index');
    }

    public function datables(Plans $plans){
        $plans = Plans::complete();
        return DataTables::of($plans)->make(true);
    }

    public function create(){

        $adesions = Adesions::pluck('name', 'id');
        $adesions->prepend('Selecione', 0);
        return view('admin.planos.formulario')
        ->with('adesions', $adesions);

    }

    public function update($id, Plans $plan){
        $plan = Plans::findOrFail($id);
        $adesions = Adesions::pluck('name', 'id');

        return view('admin.planos.formulario')
        ->with('adesions', $adesions)
        ->with('plan', $plan);
    }

    public function savecreate(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'points' => 'required',
            'id_adesion' => 'required',
        ]);

        $request->merge(['points' => $this->formatMoeda($request->points)]);

        Plans::create($request->all());
        \Session::flash('mensagem_sucesso','O plano '.$request->name.' foi CRIADO com sucesso.');
        return Redirect::to('/admin/planos');
    }

    public function saveupdate($id, Plans $plan, Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'points' => 'required',
            'id_adesion' => 'required',
        ]);
        $request->merge(['points' => $this->formatMoeda($request->points)]);

        $plan = Plans::findOrFail($id);
        $plan->update($request->all());

        \Session::flash('mensagem_sucesso','O plano '.$request->name.' foi EDITADO com sucesso.');
        return Redirect::to('/admin/planos');

    }

    public function delete($id){
        $plans = Plans::findOrFail($id);
        return  response()->json($plans->delete());
    }
}
