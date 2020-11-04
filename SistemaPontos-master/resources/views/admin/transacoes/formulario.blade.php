@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Nova transação</h3>
    </div>

    <div class="box-body">
        <div class="row">
            @if (Request::is('*/editar'))
                {{ Form::model($transactions, ['method' => 'PATCH', 'url' => 'admin/transacoes/'.$transactions->id.'/salvar' ]) }}
            @else
                {{ Form::open(['url'=>'admin/transacoes/salvar']) }}
            @endif
           
            <div class="form-group col-md-3">
                {{ Form::label('type','Tipo de transação')}}
                {{ Form::select('type', array('' => 'Selecione', '1' => 'Crédito', '0' => 'Exclusão',), null, array('class' => 'form-control ')) }}
                @if ($errors->has('type'))
                <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-md-3">
                {{ Form::label('id_plan','Plano')}}
                {{ Form::select('id_plan', $plan, null, array('class' => 'form-control ')) }}
                @if ($errors->has('id_plan'))
                <span class="help-block">
                        <strong>{{ $errors->first('id_plan') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-md-3">
                {{ Form::label('id_receive','Destinatário')}}
                {{ Form::select('id_receive', $user, null, array('class' => 'form-control ')) }}
                @if ($errors->has('id_receive'))
                <span class="help-block">
                        <strong>{{ $errors->first('id_receive') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-md-3">
                {{ Form::label('plate','Placa do veículo')}}
                {{ Form::input('text','plate', null, array('class' => 'form-control ')) }}
                @if ($errors->has('plate'))
                <span class="help-block">
                        <strong>{{ $errors->first('plate') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group col-md-6">
                    {{ Form::label('obs','Observação')}}
                    {{ Form::textarea('obs',null, array('class' => 'form-control ', 'rows' => '5')) }}
                    @if ($errors->has('obs'))
                    <span class="help-block">
                            <strong>{{ $errors->first('obs') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group col-md-3" id="box_status">
                {{ Form::label('status','Status dos créditos')}}
                {{ Form::select('status', array('' => 'Selecione', '1' => 'Aguardando'), null, array('class' => 'form-control ')) }}
                @if ($errors->has('status'))
                <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                </span>
                @endif
            </div>

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

    $('#type').on('change', function () {
        if($(this).val() == 0){
            $('#box_status').css('display', 'none');
        }else{
            $('#box_status').css('display', 'block');
        }
    })
});
</script>
@stop
