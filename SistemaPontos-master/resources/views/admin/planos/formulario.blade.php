@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Novo plano</h3>
    </div>

    <div class="box-body">
        <div class="row">
            @if (Request::is('*/editar'))
                {{ Form::model($plan, ['method' => 'PATCH', 'url' => 'admin/planos/'.$plan->id.'/salvar' ]) }}
            @else
                {{ Form::open(['url'=>'admin/planos/salvar']) }}
            @endif
            <div class="form-group col-md-3">
                    {{ Form::label('name','Nome')}}
                    {{ Form::input('text','name', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('name'))
                    <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group col-md-3">
                    {{ Form::label('points','Valor')}}
                    {{ Form::input('tel','points', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('points'))
                    <span class="help-block">
                            <strong>{{ $errors->first('points') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group col-md-3">
                {{ Form::label('id_adesion','Adesão do plano')}}
                {{ Form::select('id_adesion', $adesions, null, array('class' => 'form-control ')) }}
                @if ($errors->has('id_adesion'))
                <span class="help-block">
                        <strong>{{ $errors->first('id_adesion') }}</strong>
                </span>
                @endif
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
    $('#points').mask('0.000,00', {reverse: true});
});
</script>
@stop
