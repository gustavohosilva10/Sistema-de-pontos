@extends('adminlte::page')

@section('title', 'Nova adesão')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Nova adesão</h3>
    </div>

    <div class="box-body">
        <div class="row">
            @if (Request::is('*/editar'))
                {{ Form::model($adesion, ['method' => 'PATCH', 'url' => 'admin/adesao/'.$adesion->id.'/salvar' ]) }}
            @else
                {{ Form::open(['url'=>'admin/adesao/salvar']) }}
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
                    {{ Form::label('description','Descrição')}}
                    {{ Form::input('text','description', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('description'))
                    <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group col-md-3">
                {{ Form::label('status','Status')}}
                {{ Form::select('status', array('' => 'Selecione', '0' => 'Ativo', '1' => 'Desativado'), null, array('class' => 'form-control ')) }}
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