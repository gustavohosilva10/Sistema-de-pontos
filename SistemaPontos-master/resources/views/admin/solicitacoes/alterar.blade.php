@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Alterar resgate de pontos</h3>
    </div>

    <div class="box-body">
        <div class="row">

            {{ Form::open(['url'=>'admin/solicitacoes/'.$id.'/salvar']) }}

            <div class="form-group col-md-3">
                {{ Form::label('status','Status da solicitação')}}
                {{ Form::select('status', array('' => 'Selecione', 1 => 'Aprovado', 2 => 'Cancelado'), null, array('class' => 'form-control ')) }}
                @if ($errors->has('status'))
                <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                </span>
                @endif
            </div>

        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right"> Salvar </button>
        </div>
        {{ Form::close() }}
    </div>
</div>

@stop

@section('js')
<script>
$(function() {
    $('#points').mask('0000', {reverse: true});
});
</script>
@stop
