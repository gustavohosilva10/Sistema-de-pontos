@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.register_message') }}</p>
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                           placeholder="{{ trans('adminlte::adminlte.full_name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" id="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="form-group has-feedback {{ $errors->has('telephone') ? 'has-error' : '' }}">
                    <input type="tel" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}"
                            placeholder="Telefone">
                    @if ($errors->has('telephone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telephone') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('function') ? 'has-error' : '' }}">
                    <input type="text" name="function" id="function" class="form-control" placeholder="Função na empresa" >
                    @if ($errors->has('function'))
                        <span class="help-block">
                            <strong>{{ $errors->first('function') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('location_work') ? 'has-error' : '' }}">
                    <input type="text" name="location_work" class="form-control"
                            placeholder="Local de trabalho">
                    @if ($errors->has('location_work'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location_work') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('cpf') ? 'has-error' : '' }}">
                    <input type="tel" name="cpf" id="cpf" class="form-control"
                            placeholder="CPF">
                    @if ($errors->has('cpf'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('bank') ? 'has-error' : '' }}">
                    <select name="bank" id="bank" placeholder="Banco" class="form-control">
                        <option value="">Selecione o banco</option>
                        <option value="001 – Banco do Brasil S.A.">001 – Banco do Brasil S.A.</option>
                        <option value="341 – Banco Itaú S.A.">341 – Banco Itaú S.A.</option>
                        <option value="033 – Banco Santander (Brasil) S.A.">033 – Banco Santander (Brasil) S.A.</option>
                        <option value="237 – Banco Bradesco S.A.">237 – Banco Bradesco S.A.</option>
                        <option value="745 – Banco Citibank S.A.">745 – Banco Citibank S.A.</option>
                        <option value="104 – Caixa Econômica Federal">104 – Caixa Econômica Federal</option>
                        <option value="389 – Banco Mercantil do Brasil S.A.">389 – Banco Mercantil do Brasil S.A.</option>
                    </select>
                </div>

                <div class="form-group has-feedback {{ $errors->has('agency') ? 'has-error' : '' }}">
                    <input type="tel" name="agency" id="agency" class="form-control"
                            placeholder="Agência">
                    @if ($errors->has('agency'))
                        <span class="help-block">
                            <strong>{{ $errors->first('agency') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('account') ? 'has-error' : '' }}">
                    <input type="tel" name="account" id="account" class="form-control"
                            placeholder="Conta">
                    @if ($errors->has('account'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('account_type') ? 'has-error' : '' }}">
                    <select type="text" name="account_type" id="account_type" placeholder="Tipo de conta" class="form-control">
                        <option value="">Nenhum tipo selecionado</option>
                        <option value="corrente">Conta corrente</option>
                        <option value="poupança">Conta poupança</option>
                    </select>
                </div>


                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >{{ trans('adminlte::adminlte.register') }}</button>
            </form>
            <div class="auth-links">
                <a href="{{ url(config('adminlte.login_url', 'login')) }}"
                   class="text-center">{{ trans('adminlte::adminlte.i_already_have_a_membership') }}</a>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    @yield('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#cpf").mask('000.000.000-00');
            $("#telephone").mask('(00) 00000-0000');
            $("#agency").mask('00000');
            $("#account").mask('00000000000-0', {'reverse':true});
            
        });
    </script>
@stop
