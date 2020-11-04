@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content') 
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Transações do sistema</h3>
        <span class="pull-right">
            SEU SALDO: <span class="label label-default">R$ {{$saldo}}</span>
        </span>
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
                    <th> Tipo </th>
                    <th> Placa </th>
                    <th> Plano </th>
                    <th> Consultor </th>
                    <th> Valor </th>
                    <th> Data transação </th>
                    <th> Status crédito </th>
                </tr>
            </thead>

        </table>
        <div class="box-footer">
            @can('admin', $user)
                <a href="transacoes/novo" class="btn btn-primary pull-right"> <i class="fas fa-plus"> </i> Nova transação </a>
            @else
                <a href="conta/{{$account->id}}/resgate" class="btn btn-primary pull-right"> <i class="fas fa-shopping-cart"> </i> Solicitar resgate </a>
            @endcan
        </div>

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
        ajax: '/admin/transacoes/tbl-json',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'type', name: 'type' },
            { data: 'plate', name: 'plate' },
            { data: 'plan', name: 'plan' },
            { data: 'receive', name: 'receive' },
            { data: 'points', name: 'points' },
            { data: 'created_at', name: 'created_at' },

        ],
        "columnDefs": [
        { "targets": 0, "render": function (data, type, row) {
            return "#"+row.id;
        }},
        { "targets": 1, "render": function (data, type, row) {

            t_transacao = row.type;

                if(row.obs != null){
                    obs = "<i class='fas fa-tags' title='"+row.obs+"'></i> ";
                }else{
                    obs = '';
                }

                switch(t_transacao){

                case 0:
                    var status = "<span class='label label-danger'>Excluido</span> "+obs;
                break;

                case '1':
                    var status = "<span class='label label-success'>Crédito</span> "+obs;
                break;

                case '2':
                    var status = "<span class='label label-warning'>Solicitação</span> "+obs;
                break;

                }

            return status;
        }},
        { "targets": 5, "render": function (data, type, row) {

            var t_transacao = row.type;
            switch(parseInt(t_transacao)){
                case 0:
                    var type = "- "+parseFloat(row.points).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                break;

                case 1:
                    var type = "+ "+parseFloat(row.points).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                break;

                case 2:
                    var type = "- "+parseFloat(row.points).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                break;

            }

            return type;
        }},
        {"targets": 7, "render": function (data, type, row) {

            st_transacao = row.status;

                switch(st_transacao){

                case 0:
                    var status = " <span class='label label-warning'>Aguardando</span> @if(\Auth::user()->type  === 0) <a href='transacoes/"+row.plate+"/"+row.id_plan+"/"+row.id+"/"+row.id_receive+"/"+row.points+"/alterar-status' class='btn btn-xs btn-default'><i class='fas fa-edit'> </i></a> @endif";
                break;

                case '1':
                    var status = "<span class='label label-success'>Aprovado</span> ";
                break;

                }

            return status;
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
