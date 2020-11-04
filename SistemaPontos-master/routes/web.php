<?php

Auth::routes();

Route::redirect('/', '/admin', 301);

Route::prefix('admin')->group(function () {

    Route::get('/', 'HomeController@index');

    // indicacaoes
    Route::get('/aplicativo/indicacoes/listar', 'Api\IndicationController@list');
    Route::get('/aplicativo/indicacoes/list-tbl-json', 'Api\IndicationController@listDatatables');

    // Solicitações
    Route::get('/solicitacoes', 'RequestsController@index');

    Route::get('/solicitacoes/{id}/alterar', 'RequestsController@alterar');
    Route::post('/solicitacoes/{id}/salvar', 'RequestsController@salvar');
    Route::get('/solicitacoes/tbl-json', 'RequestsController@datables');

    // Funcoes Conta
    Route::get('/conta/{id}/resgate', 'AccountsController@resgate');
    Route::post('/conta/{id}/debito', 'AccountsController@saveResgate');
    Route::post('/conta/{id}/credito', 'AccountsController@credito');

    // CRUD Planos
    Route::get('/planos', 'PlansController@index');
    Route::get('/planos/tbl-json', 'PlansController@datables');
    Route::get('/planos/novo', 'PlansController@create');
    Route::post('/planos/salvar', 'PlansController@savecreate');

    Route::get('/planos/{id}/editar', 'PlansController@update');
    Route::patch('/planos/{id}/salvar', 'PlansController@saveupdate');
    Route::delete('/planos/{id}/deletar', 'PlansController@delete');

    // CRUD adesões
    Route::get('/adesao', 'AdesionsController@index');
    Route::get('/adesao/tbl-json', 'AdesionsController@datables');
    Route::get('/adesao/novo', 'AdesionsController@create');
    Route::post('/adesao/salvar', 'AdesionsController@store');
    Route::get('/adesao/{id}/editar', 'AdesionsController@edit');
    Route::patch('/adesao/{id}/salvar', 'AdesionsController@update');
    Route::delete('/adesao/{id}/deletar', 'AdesionsController@destroy');

    
    // CRUD indicações
    Route::get('/indicacao', 'IndicationsController@index');
    Route::get('/indicacao/tbl-json', 'IndicationsController@datables');
    Route::get('/indicacao/novo', 'IndicationsController@create');
    Route::post('/indicacao/salvar', 'IndicationsController@store');
    Route::get('/indicacao/{id}/editar', 'IndicationsController@edit');
    Route::patch('/indicacao/{id}/salvar', 'IndicationsController@update');
    Route::delete('/indicacao/{id}/deletar', 'IndicationsController@destroy');

    // CRUD Produtos
    Route::get('/produtos', 'ProductsController@index');
    Route::get('/produtos/tbl-json', 'ProductsController@datables');
    Route::get('/produtos/novo', 'ProductsController@create');
    Route::post('/produtos/salvar', 'ProductsController@savecreate');

    Route::get('/produtos/{id}/editar', 'ProductsController@update');
    Route::patch('/produtos/{id}/salvar', 'ProductsController@saveupdate');
    Route::delete('/produtos/{id}/deletar', 'ProductsController@delete');

    Route::get('/produtos/lista-produtos', 'ProductsController@listAll');
    Route::get('/produtos/lista-produtos/{id}', 'ProductsController@listProductsForID');

    // CRUD Imagens
    Route::get('/produtos/{id}/imagens', 'GalleryProductsController@create');
    Route::post('/produtos/{id}/imagens/salvar', 'GalleryProductsController@savecreate');

    // CRUD Transacoes
    Route::get('/transacoes', 'TransactionsController@index');

    Route::get('/transacoes/{plate}/{id_plan}/{id}/{id_receive}/{saldo}/alterar-status', 'TransactionsController@FormStatus');
    Route::patch('/transacoes/{id}/save-status', 'TransactionsController@saveStatus');

    Route::get('/transacoes/tbl-json', 'TransactionsController@datables');
    Route::get('/transacoes/novo', 'TransactionsController@create');
    Route::post('/transacoes/salvar', 'TransactionsController@savecreate');

    // CRUD Planos
    Route::get('/usuarios', 'UsersController@index');
    Route::get('/usuarios/tbl-json', 'UsersController@datables');
    Route::get('/usuarios/novo', 'UsersController@create');
    Route::post('/usuarios/salvar', 'UsersController@savecreate');

    Route::get('/usuarios/{id}/editar', 'UsersController@update');
    Route::patch('/usuarios/{id}/salvar', 'UsersController@saveupdate');
    Route::delete('/usuarios/{id}/deletar', 'UsersController@delete');

});


