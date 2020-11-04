@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Novo indicação</h3>
    </div>

    <div class="box-body">
        <div class="row">
            @if (Request::is('*/editar'))
                {{ Form::model($indication, ['method' => 'PATCH', 'url' => 'admin/indicacao/'.$indication->id.'/salvar' ]) }}
            @else
                {{ Form::open(['url'=>'admin/indicacao/salvar']) }}
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
                    {{ Form::label('email','E-mail')}}
                    {{ Form::input('text','email', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
            </div>
            
            <div class="form-group col-md-3">
                    {{ Form::label('telephone','WhatsApp')}}
                    {{ Form::input('text','telephone', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('telephone'))
                    <span class="help-block">
                            <strong>{{ $errors->first('telephone') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group col-md-12">
				<legend>Dados do veículo</legend>
            </div>

            <div class="form-group col-md-3">
                    {{ Form::label('type_vehicle','Tipo de veículo')}}
                    {{ Form::input('text','type_vehicle', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('type_vehicle'))
                    <span class="help-block">
                            <strong>{{ $errors->first('type_vehicle') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group col-md-3">
                    {{ Form::label('manufacturer','Marca')}}
                    {{ Form::input('text','manufacturer', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('manufacturer'))
                    <span class="help-block">
                            <strong>{{ $errors->first('manufacturer') }}</strong>
                    </span>
                    @endif
            </div>
            
            <div class="form-group col-md-3">
                    {{ Form::label('model','Modelo')}}
                    {{ Form::input('text','model', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('model'))
                    <span class="help-block">
                            <strong>{{ $errors->first('model') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group col-md-3">
                {{ Form::label('status','Status')}}
                {{ Form::select('status', array('' => 'Selecione', '0' => 'Fechou', '1' => 'Não fechou'), null, array('class' => 'form-control ')) }}
                @if ($errors->has('status'))
                <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
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
