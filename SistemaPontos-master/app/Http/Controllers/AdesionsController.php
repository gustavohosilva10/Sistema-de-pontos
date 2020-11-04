<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DataTables, Redirect;
use App\Models\Adesions;

class AdesionsController extends Controller
{
   
    public function index()
    {
        return view('admin.adesao.index');
    }

    
    public function create()
    {
        return view('admin.adesao.formulario');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        Adesions::create($request->all());
        \Session::flash('mensagem_sucesso','A adesão '.$request->name.' foi CRIADA com sucesso.');
        return Redirect::to('/admin/adesao');
    }

    public function show($id)
    {
        //
    }

    public function datables(){
        $adesions = Adesions::all();
        return DataTables::of($adesions)->make(true);
    }
 
    public function edit($id)
    {
        $adesion = Adesions::findOrFail($id);
        return view('admin.adesao.formulario')
        ->with('adesion', $adesion);
        
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $adesion = Adesions::findOrFail($id);
        $adesion->update($request->all());

        \Session::flash('mensagem_sucesso','A adesão '.$request->name.' foi EDITADA com sucesso.');
        return Redirect::to('/admin/adesao');
    }

    public function destroy($id)
    {
        $adesion = Adesions::findOrFail($id);
        return  response()->json($adesion->delete());
    }
}
