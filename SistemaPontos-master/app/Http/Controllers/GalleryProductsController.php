<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\GalleryProducts;

use Redirect;

class GalleryProductsController extends Controller{

    public function index(){
        return view('admin.produtos.index');
    }

    public function create($id, Products $products){
        $products = Products::findOrFail($id);
        return view('admin.produtos.imagens')->with(compact('products', $products));
    }

    public function savecreate($id, Request $request){

        $validatedData = $request->validate([
            'imagem[]' => 'mimes:jpeg,png,jpg|max:4096',
        ]);

        if($request->hasfile('imagem')) {

            foreach($request->file('imagem') as $image){

                $name = rand(1,999999).'.'.$image->getClientOriginalExtension();

                $image->move(public_path('images'), $name,777);

                $request->merge(['imagem' => 'url_img']);
                GalleryProducts::create(['id_product' => $id, 'url_img' =>  $name ]);
            }

            \Session::flash('mensagem_sucesso','Os arquivos foram enviados COM SUCESSO.');
         }else{
            \Session::flash('mensagem_sucesso','HOUVE ERROS ao processar seu arquivo.');
            return Redirect::to('/admin/produtos');
        }

        return Redirect::to('/admin/produtos');
    }
}
