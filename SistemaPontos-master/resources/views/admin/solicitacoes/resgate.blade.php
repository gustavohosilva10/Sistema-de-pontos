@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Solicitar resgate de pontos</h3>

    <div class="box-tools pull-right">
            <span class="label label-success" style="margin-top:10px;font-size:12px;">Saldo: {{ $saldo }} </span>
        </div>
    </div>

    <div class="box-body">
        <div class="row">

            {{ Form::open(['url'=>'admin/conta/'.$account->id.'/debito']) }}

            <div class="col-md-6">
                <div class="box box-solid">

                    <div class="box-body">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner slide-itens">
                                <div class='item active'> <img src='/imgs/default.png' alt='Default'> </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="fa fa-angle-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                            </a>
                        </div>

                        <div class="box" style="margin-top:10px">
                            <div class="box-header with-border">
                                <h3 class="box-title name"></h3>
                            </div>
                            <div class="box-body description"> </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="row">

                    <div class="form-group col-md-12">
                        {{ Form::label('id_products','Produtos disponíveis')}}
                        <select class="form-control produtos" id="id_products" name="id_products" onchange="teste();">
                            <option value=""> Selecione </option>
                        </select>
                        @if ($errors->has('id_products'))
                        <span class="help-block">
                            <strong>{{ $errors->first('id_products') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        {{ Form::label('qt_stock','Quantidade em estoque')}}
                        {{ Form::input('qt_stock','qt_stock', null, array('class' => 'form-control', 'disabled' => 'disabled')) }}
                    </div>

                    <div class="form-group col-md-12">

                        {{ Form::label('points','Quantidade de pontos')}}
                        {{ Form::input('number','points', null, array('class' => 'form-control ')) }}
                        @if ($errors->has('points'))
                        <span class="help-block">
                                <strong>{{ $errors->first('points') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>

            </div>

        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right"> Resgatar </button>
        </div>

        {{ Form::close() }}
    </div>
</div>

@stop

@section('js')
<script>

    $(document).ready(function(){

        $.LoadingOverlay('show');

        $.get({
            url: '/admin/produtos/lista-produtos',
            success: function(data){

                if(data != 'undefined'){

                    $.each(data, function(i, d) {
                        if(d.qt_stock > 0){
                            $('.produtos').append("<option value='"+d.id+"'>"+d.name+"</option>");
                        }

                    })

                };
                $.LoadingOverlay('hide');
            },
        });
    })

function teste(){

    id = $('#id_products').val();

    $.LoadingOverlay('show');
        $.get({
            url: '/admin/produtos/lista-produtos/'+id,
            success: function(data){
                $.LoadingOverlay('hide');

                if(data != 'undefined'){

                    $.each(data, function(i, d) {

                        $('.name').html(d.name);
                        $('.description').html(d.description);
                        $('#points').val(d.points_required);
                        $('#qt_stock').val(d.qt_stock);

                        if(d.with_imagens.length > 0){
                            $('.slide-itens').html("");

                            $.each(d.with_imagens, function(i, img) {

                                if(i === 0){
                                    $('.slide-itens').append("<div class='item active'> <img src='/images/"+img.url_img+"' alt="+d.name+"> </div>");
                                }else{
                                    $('.slide-itens').append("<div class='item'> <img src='/images/"+img.url_img+"' alt="+d.name+"> </div>");
                                }
                            })

                        }else{

                        }

                    })

                };
            },
        });
}

$(function() {
    $('#points').mask('#0.0', {reverse: true});
});
</script>
@stop

