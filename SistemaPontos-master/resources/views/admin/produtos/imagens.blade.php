@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Adicionar imagens</h3>
    </div>

    <div class="box-body">
        <div class="row">

            @if (Request::is('*/editar'))
                {{ Form::model($products, ['method' => 'PATCH', 'url' => 'admin/produtos/'.$products->id.'/imagens/salvar' ]) }}
            @else
                {{ Form::open(['url'=>'admin/produtos/'.$products->id.'/imagens/salvar','files'=> true ]) }}
            @endif

            <div class="form-group col-md-6">
                {{ Form::label('imagem','Imagem do produto')}}
                {{ Form::file('imagem[]', array('class' => 'form-control', 'multiple')) }}
            </div>

        </div>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right"> Salvar </button>
    </div>
    {{ Form::close() }}
</div>

@stop

@section('js')
<script>
$(function() {
    $('#points').mask('0000', {reverse: true});
});
</script>
@stop
