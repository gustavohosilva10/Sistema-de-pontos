@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Usuários</h3>
    </div>

    <div class="box-body">
        <div class="row">

            @if (Request::is('*/editar'))
                {{ Form::model($user, ['method' => 'PATCH', 'url' => 'admin/usuarios/'.$user->id.'/salvar' ]) }}
            @else
                {{ Form::open(['url'=>'admin/usuarios/salvar']) }}
            @endif

            <div class="form-group col-md-3">
                {{ Form::label('type','Tipo de usuário')}}
                {{ Form::select('type', array('' => 'Selecione', 0 => 'Administrador', 1 => 'Consultor'), null, array('class' => 'form-control ')) }}
                @if ($errors->has('type'))
                <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                </span>
                @endif
            </div>

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
                    {{ Form::label('telephone','Telefone')}}
                    {{ Form::input('tel','telephone', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('telephone'))
                    <span class="help-block">
                            <strong>{{ $errors->first('telephone') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group col-md-3">
                    {{ Form::label('email','E-mail')}}
                    {{ Form::input('email','email', null, array('class' => 'form-control ')) }}
                    @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group col-md-3">
				{{ Form::label('location_work','Local de atuação')}}
				{{ Form::input('text','location_work', null, array('class' => 'form-control ')) }}
				@if ($errors->has('location_work'))
				<span class="help-block">
						<strong>{{ $errors->first('location_work') }}</strong>
				</span>
				@endif
			</div>
			
            <div class="form-group col-md-3">
				{{ Form::label('function','Função')}}
				{{ Form::input('text','function', null, array('class' => 'form-control ')) }}
				@if ($errors->has('function'))
				<span class="help-block">
						<strong>{{ $errors->first('function') }}</strong>
				</span>
				@endif
            </div>

            <div class="form-group col-md-3">
				{{ Form::label('cpf','CPF')}}
				{{ Form::input('tel','cpf', null, array('class' => 'form-control ')) }}
				@if ($errors->has('cpf'))
				<span class="help-block">
						<strong>{{ $errors->first('cpf') }}</strong>
				</span>
				@endif
            </div>
            
			<div class="col-md-12">
				<legend> Dados bancários</legend>
			</div>
			
            <div class="form-group col-md-3">
                {{ Form::label('bank','Banco')}}
                {{ Form::input('text','bank', null, array('class' => 'form-control ')) }}
                @if ($errors->has('bank'))
                <span class="help-block">
                        <strong>{{ $errors->first('bank') }}</strong>
                </span>
                @endif
			</div>
			
			<div class="form-group col-md-3">
				{{ Form::label('account','Conta')}}
				{{ Form::input('tel','account', null, array('class' => 'form-control ')) }}
				@if ($errors->has('account'))
				<span class="help-block">
						<strong>{{ $errors->first('account') }}</strong>
				</span>
				@endif
			</div>
			
			<div class="form-group col-md-3">
				{{ Form::label('agency','Agência')}}
				{{ Form::input('tel','agency', null, array('class' => 'form-control ')) }}
				@if ($errors->has('agency'))
				<span class="help-block">
						<strong>{{ $errors->first('agency') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group col-md-3">
				{{ Form::label('account_type','Tipo')}}
				{{ Form::input('tel','account_type', null, array('class' => 'form-control ')) }}
				@if ($errors->has('account_type'))
				<span class="help-block">
						<strong>{{ $errors->first('account_type') }}</strong>
				</span>
				@endif
			</div>

            @if (Request::is('*/editar'))
            @else
            <div class="form-group col-md-3">
                    {{ Form::label('password','Senha')}}
                    {{ Form::password('password', array('id' => 'password', "class" => "form-control", "autocomplete" => "off")) }}
                    @if ($errors->has('password'))
                    <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group col-md-3">
                    {{ Form::label('password_confirmation','Confirma senha')}}
                    {{ Form::password('password_confirmation', array('id' => 'password_confirmation', "class" => "form-control", "autocomplete" => "off")) }}
                    @if ($errors->has('password'))
                    <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
            </div>
            @endif
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"> Salvar </button>
            </div>
                {{ Form::close() }}
            </div>
        </div>
</div>

@stop

@section('js')
<script>
$(function() {
    $('#telephone').mask('(00) 0000-0000');
});
</script>
@stop
