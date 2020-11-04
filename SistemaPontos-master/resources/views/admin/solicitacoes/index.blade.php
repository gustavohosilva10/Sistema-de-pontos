@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')

<div class="box">
    <div class="box-header with-border">
            <h3 class="box-title">Solicitações do sistema</h3>
    </div>
    <div class="box-body">

        @if (Session::has('mensagem_sucesso'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('mensagem_sucesso') }}
            </div>
        @endif

        <table class="table table-bordered" id="table" style="width:100%">

            <thead>
                <tr>
                    <th> ID </th>
                    <th> Solicitante </th>
                    <th> Valor </th>
                    <th> Item </th>
                    <th> Observação </th>
                    <th> Data solicitação </th>
                    <th> Status </th>
                    <th> Ações</th>
                </tr>
            </thead>

        </table>
    </div>

    <div class="box-footer">
        @can('admin', $user)
            <a href="transacoes/novo" class="btn btn-primary pull-right"> <i class="fas fa-plus"> </i> Nova transação </a>
        @else
            <a href="conta/{{$account->id}}/resgate" class="btn btn-primary pull-right"> <i class="fas fa-shopping-cart"> </i> Solicitar resgate </a>
        @endcan
    </div>

</div>
@stop

@section('js')
<script>
$(function() {
    var table = $('#table').DataTable({
            "dom": "'B'"+"<'row'<'col-xs-6'l><'col-xs-6'f>>\
            <'row'<'col-xs-12'<'table-responsive't>r>>\
            <'row'<'col-xs-5'i><'col-xs-7'p>>",
        buttons: [
            {
                extend:    'excelHtml5',
                text:      '<i class="fas fa-file-excel-o"></i>',
                titleAttr: 'Exportar Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fas fa-file-pdf-o"></i>',
                titleAttr: 'Exportar PDF'
            },
            {
                extend:    'colvis',
                text:      '<i class="fas fa-filter"></i>',
                titleAttr: 'Filtrar',
            },
        ],
        lengthChange: false,
        autoFill: true,
        select: { style: 'multi' },
        processing: true,
        ajax: '/admin/solicitacoes/tbl-json',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'receive', name: 'receive' },
            { data: 'points', name: 'points' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'created_at', name: 'created_at' },
        ],
        "columnDefs": [
        { "targets": 0, "render": function (data, type, row) {
            return "#"+row.id;
        }},
        { "targets": 2, "render": function (data, type, row) {

            formatMoney = parseFloat(row.points).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            return formatMoney;
        }},
        { "targets": 3, "render": function (data, type, row) {
            return "--";
        }},
        { "targets": 4, "render": function (data, type, row) {
            return "--";
        }},
         { "targets": 6, "render": function (data, type, row) {

            t_status = row.status;

            switch(parseInt(t_status)){
                case 0:
                    var status = "<span class='label label-warning'>Aguardando liberação</span>";
                break;
                case 1:
                    var status = "<span class='label label-primary'>Atendida</span>";
                break;
                case 2:
                    var status = "<span class='label label-danger'>Cancelada</span>";
                break;
                }

            return status;
        }},
        { "targets": 7, "render": function (data, type, row) {

            t_status = row.status;
            switch(parseInt(t_status)){
                case 0:
                    html = "@can('admin', $user) <a href='/admin/solicitacoes/"+row.id+"/alterar' class='btn btn-default btn-xs' ><i class='fas fa-refresh'></i></a> @endcan";
                break;
                case 1:
                    html = "<span class='label label-success'>Resgatado</span>";
                break;
                case 2:
                    html = "<span class='label label-danger'>Cancelada</span>";
                break;
            }

            return html;
        }},
        ],
        'language': {
        "lengthMenu": "_MENU_ p/ página",
        "search": "Buscar: ",
        "loadingRecords": "Carregando...",
        "processing": "Processando...",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ transações",
        "paginate": {
        "first":      "Primeiro",
        "last":       "Último",
        "next":       "Próximo",
        "previous":   "Anterior"
            },
        "zeroRecords":    "Opa, nenhuma transação foi efetuada.",
            },
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
    });
});
</script>
@stop
