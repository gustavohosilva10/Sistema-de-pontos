@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content_header')
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li><a href="/admin"><i class="fas fa-home"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
@stop

@section('content')
@can('admin', $user)
<div class="row">

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="fas fa-check"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Total</span>
            <span class="info-box-number"><small>{{ $saldo }}</small></span>

            <div class="progress">
                <div class="progress-bar" style="width: {{ $saldo }}%"></div>
            </div>
                <span class="progress-description">
                    Total distribuido
                </span>
            </div>
        </div>
    </div>

    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fas fa-arrow-up"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Crédito</span>
            <span class="info-box-number"><small>{{ $qt_credito }}</small></span>

            <div class="progress">
                <div class="progress-bar" style="width: {{ $qt_credito }}%"></div>
            </div>
                <span class="progress-description">
                    Operações de crédito
                </span>
            </div>
        </div>
    </div>

    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fas fa-arrow-up"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Exclusão</span>
            <span class="info-box-number"><small>{{ $qt_debito }}</small></span>

            <div class="progress">
                <div class="progress-bar" style="width: {{ $qt_debito }}%"></div>
            </div>
                <span class="progress-description">
                    Operações de débito
                </span>
            </div>
        </div>
    </div>

    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange">
            <span class="info-box-icon"><i class="fas fa-arrow-up"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Resgate</span>
            <span class="info-box-number"><small>{{ $qt_resgates }}</small></span>

            <div class="progress">
                <div class="progress-bar" style="width: {{ $qt_resgates }}%"></div>
            </div>
                <span class="progress-description">
                    Pontos resgatados
                </span>
            </div>
        </div>
    </div>

    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-gray">
            <span class="info-box-icon"><i class="fas fa-refresh"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Pendentes</span>
            <span class="info-box-number"><small>{{ $c_pendente }}</small></span>

            <div class="progress">
                <div class="progress-bar" style="width: {{ $c_pendente }}%"></div>
            </div>
                <span class="progress-description">
                    Pendente aprovação
                </span>
            </div>
        </div>
    </div>

</div>
@else
<div class="row">

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="fas fa-check"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">SALDO</span>
            <span class="info-box-number"><small>{{ $t_saldo }}</small></span>

            <div class="progress">
                <div class="progress-bar" style="width: {{ $t_saldo }}%"></div>
            </div>
                <span class="progress-description">
                    Pontos disponíveis
                </span>
            </div>
        </div>
    </div>

    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fas fa-arrow-up"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Créditos</span>
            <span class="info-box-number"><small>{{ $qt_credito }}</small></span>

            <div class="progress">
                <div class="progress-bar" style="width: {{ $qt_credito }}%"></div>
            </div>
                <span class="progress-description">
                    Operações de crédito
                </span>
            </div>
        </div>
    </div>

    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fas fa-arrow-up"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Débitos</span>
            <span class="info-box-number"><small>{{ $qt_debito }}</small></span>

            <div class="progress">
                <div class="progress-bar" style="width: {{ $qt_debito }}%"></div>
            </div>
                <span class="progress-description">
                    Operações de débito
                </span>
            </div>
        </div>
    </div>

    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange">
            <span class="info-box-icon"><i class="fas fa-arrow-up"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Resgate</span>
            <span class="info-box-number"><small>{{ $qt_resgates }}</small></span>

            <div class="progress">
                <div class="progress-bar" style="width: {{ $qt_resgates }}%"></div>
            </div>
                <span class="progress-description">
                    Pontos resgatados
                </span>
            </div>
        </div>
    </div>

    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-gray">
            <span class="info-box-icon"><i class="fas fa-refresh"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Pendentes</span>
            <span class="info-box-number"><small>{{ $c_pendente }}</small></span>

            <div class="progress">
                <div class="progress-bar" style="width: {{ $c_pendente }}%"></div>
            </div>
                <span class="progress-description">
                    Pendente aprovação
                </span>
            </div>
        </div>
    </div>

</div>
@endcan

@stop