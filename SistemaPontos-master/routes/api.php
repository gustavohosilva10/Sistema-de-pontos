<?php

use Illuminate\Http\Request;

Route::group(['middleware' => ['api','APIkey', 'cors']], function () {

    Route::post('auth/login', 'Auth\LoginController@login');
    Route::post('auth/register', 'Auth\ApiRegisterController@register');

    Route::post('indicacao/inserir', 'Api\IndicationController@create');

});
