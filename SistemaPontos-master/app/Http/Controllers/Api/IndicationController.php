<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DataTables;
use Validator;

use App\Http\Controllers\Controller;
use App\Models\Indications;

class IndicationController extends Controller {

    function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'string|required|min:10',
            'telephone' => 'required|min:12',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $teste = Indications::create($request->all());
        if($teste){
            return response()->json(['gravou'=> true, 'mensagem'=>'Obrigado pela indicação! :)']);
        }else{
            return response()->json(['gravou'=>false, 'mensagem' => 'Houve erros ao inserir sua indicação! Tentar novamente?']);
        }
    }

    function list(){

        return view('admin.aplicativo.lista');

    }

    function listDatatables(){

        $indications = Indications::all();
        return DataTables::of($indications)->make(true);

    }

    function listIndicationsForID($id){

        $indications = Indications::where('id', $id);
        return response()->json($indications);

    }

}
