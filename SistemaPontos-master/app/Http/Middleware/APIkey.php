<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class APIkey {

    public function handle($request, Closure $next) {

        if($request->api_token == '') {
            return response()->json('API KEY Vazia');
        }else
            $users = User::where('api_token', $request->api_token)->count();
        if ($users != 1) {
            return response()->json('API KEY Inválida');
        }else{
            return $next($request);
        }

    }
}
