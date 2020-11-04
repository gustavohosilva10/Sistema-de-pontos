@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Status de créditos da transação</h3>
    </div>

    <div class="box-body">
        <div class="row">
            
            {{ Form::model($transactions, ['method' => 'PATCH', 'url' => 'admin/transacoes/'.$transactions->id.'/save-status' ]) }}
            
            <div class="form-group col-md-6">
                {{ Form::label('obs','Observação')}}
                {{ Form::textarea('obs',null, array('class' => 'form-control ', 'rows' => '5')) }}
                @if ($errors->has('obs'))
                <span class="help-block">
                        <strong>{{ $errors->first('obs') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-md-3">
                {{ Form::label('status','Status dos créditos')}}
                {{ Form::select('status', array('' => 'Selecione', '1' => 'Aprovado', '2' => 'Negado'), null, array('class' => 'form-control ')) }}
                @if ($errors->has('status'))
                <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                </span>
                @endif
            </div>

              {{ Form::hidden('plate', null, array('plate' => $plate )) }}
              {{ Form::hidden('id_plan', null, array('id_plan' => $id_plan )) }}
              {{ Form::hidden('id_receive', null, array('id_receive' => $id_receive )) }}
              {{ Form::hidden('id', null, array('id' => $id )) }}

        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right"> Salvar </button>
        </div>
          {{ Form::close() }}
    </div>
</div>

@stop

@section('js')
<script>
$(function() {
    $('#cep').mask('00000-000', {reverse: true});
    $('#telephone').mask('(00) 0000-0000');
    $('#plate').mask('AAA-0000');
});
</script>
@stop
