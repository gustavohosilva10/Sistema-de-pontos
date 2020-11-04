@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Novo produto</h3>
    </div>

    <div class="box-body">
        <div class="row">
            @if (Request::is('*/editar'))
                {{ Form::model($products, ['method' => 'PATCH', 'url' => 'admin/produtos/'.$products->id.'/salvar' ]) }}
            @else
                {{ Form::open(['url'=>'admin/produtos/salvar']) }}
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
                    {{ Form::label('points_required','Pontos necessário para resgate')}}
                    {{ Form::input('text','points_required', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('points_required'))
                    <span class="help-block">
                            <strong>{{ $errors->first('points_required') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group col-md-3">
                    {{ Form::label('qt_stock','Quantidade estoque')}}
                    {{ Form::input('text','qt_stock', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('qt_stock'))
                    <span class="help-block">
                            <strong>{{ $errors->first('qt_stock') }}</strong>
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

@section('js')
<script>
$(function() {
    $('#points').mask('#0.0', {reverse: true});
});
</script>
@stop
