<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indications;

use Redirect, DataTables;

class IndicationsController extends Controller
{
    public function index()
    {
        return view('admin.indicacao.index');
    }

    public function datables()
    {
        $indications = Indications::all();
        return DataTables::of($indications)->make(true);
    }
    public function create()
    {
        return view('admin.indicacao.formulario');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => 'required',
            "email" => 'required',
            "telephone" => 'required',
            "type_vehicle" => 'required',
            "manufacturer" => 'required',
            "model" => 'required',
            "status" => 'required',
        ]);

        Indications::create($request->all());
        \Session::flash('mensagem_sucesso','A adesão '.$request->name.' foi CRIADA com sucesso.');
        return Redirect::to('/admin/indicacao');
         

        
        //return view('admin.indicacao.formulario');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $indication = Indications::findOrFail($id);
        return view('admin.indicacao.formulario')
        ->with('indication', $indication);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "name" => 'required',
            "email" => 'required',
            "telephone" => 'required',
            "type_vehicle" => 'required',
            "manufacturer" => 'required',
            "model" => 'required',
            "status" => 'required',
        ]);

        $indication = Indications::findOrFail($id);
        $indication->update($request->all());

        \Session::flash('mensagem_sucesso','A indicação '.$request->name.' foi EDITADA com sucesso.');
        return Redirect::to('/admin/indicacao');
    }

    public function destroy($id)
    {
        $indication = Indications::findOrFail($id);
        return  response()->json($indication->delete());
    }
}
