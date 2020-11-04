<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

use DataTables;
use Redirect;

class ProductsController extends Controller
{
    public function index(){
        return view('admin.produtos.index');
    }

    public function create(){
        return view('admin.produtos.formulario');
    }

    public function datables(Products $products){
        $products = Products::all();
        return DataTables::of($products)->make(true);
    }

    public function listAll(){

        $products = Products::all();
        return response()->json($products);

    }

    public function listProductsForID($id){

        $products = Products::getProductsByID($id);
        return response()->json($products);

    }

    public function update($id, Products $products){
        $products = Products::findOrFail($id);
        return view('admin.produtos.formulario')->with('products', $products);
    }

    public function saveupdate($id, Products $products, Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'points_required' => 'required',
            'qt_stock' => 'required',
            'status' => 'required',
        ]);

        $products = Products::findOrFail($id);
        $products->update($request->all());

        \Session::flash('mensagem_sucesso','O produto '.$request->name.' foi EDITADO com sucesso.');
        return Redirect::to('/admin/produtos');

    }

    public function savecreate(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'points_required' => 'required',
            'qt_stock' => 'required',
            'status' => 'required',
        ]);

        Products::create($request->all());
        \Session::flash('mensagem_sucesso','O produto '.$request->name.' foi CRIADO com sucesso.');
        return Redirect::to('/admin/produtos');
    }

    public function delete($id){
        $products = Products::findOrFail($id);
        return  response()->json($products->delete());
    }

}
