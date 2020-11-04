@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')

<div class="box">
    <div class="box-header with-border">
            <h3 class="box-title">Adesões</h3>
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
                    <th> Nome </th>
                    <th> Descrição </th>
                    <th> Status </th>
                    <th> Criado em</th>
                    <th></th>
                </tr>
            </thead>

        </table>

        <div class="box-footer">
            <a href="adesao/novo" class="btn btn-default pull-right"> <i class="fas fa-plus"> </i> Adicionar </a>
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
        ajax: '/admin/adesao/tbl-json',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },

        ],
        "columnDefs": [
        { "targets": 2, "render": function (data, type, row) {


            switch(parseInt(row.status)){
                case 0:
                    var status = "<span class='label label-success'>ATIVO</span>";
                break;

                case 1:
                    var status = "<span class='label label-danger'>DESATIVADO</span>";
                break;

            }

            return status;
        }},
        { "targets": 4, "render": function (data, type, row) {

            html = "<a href='adesao/"+row.id+"/editar' class='btn btn-default btn-xs btn-delete'> <i class='fas fa-edit'></i> </a> <button class='btn btn-danger btn-xs btn-delete' onclick=deletar("+row.id+")><i class='fa fa-trash'></i></button> </li>";
            return html;
        }
        }],
        'language': {
        "lengthMenu": "_MENU_ p/ página",
        "search": "Buscar: ",
        "loadingRecords": "Carregando...",
        "processing": "Processando...",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ adesões",
        "paginate": {
        "first":      "Primeiro",
        "last":       "Último",
        "next":       "Próximo",
        "previous":   "Anterior"
            },
        "zeroRecords":    "Opa, nenhuma adesão foi encontrado.",
            },
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
    });
});

function deletar(id){
    $.confirm({
        title: 'Confirmação',
        content: 'Deseja mesmo deletar esse adesão?',
        dragWindowBorder: true,
        animationBounce: 1.5,
        theme: 'modern',
        buttons: {
            Cancelar: {
            btnClass: 'btn-green',
            keys: ['enter', 'space'],
            action: function(){
                console.log('Cancelado')
            }
        },
        Deletar: {
            btnClass: 'btn-red',
            keys: ['enter', 'space'],
            action: function(){
                $.LoadingOverlay('show');
                $.post({
                    url: '/admin/adesao/'+id+'/deletar',
                    method: "delete",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': id,
                    },
                    success: function(retorno){
                        $.LoadingOverlay('hide');

                        if(retorno != 'undefined'){

                            $.confirm({
                                title: 'Tudo certo',
                                content: 'A adesão foi deletada com sucesso',
                                icon: 'fa fa-warning',
                                type: 'green',
                                typeAnimated: true,
                                buttons: {
                                    Ok: {
                                        text: 'OK',
                                        btnClass: 'btn-gray',
                                        action: function(){
                                            window.location.reload();
                                        }
                                    },
                                }
                            });

                            console.log(retorno);

                        };
                    },
                    error: function(error) {
                        console.log(error);

                        $.LoadingOverlay("hide");
                        $.confirm({
                            title: 'Erro ao processar',
                            content: 'Houve erros ao processar sua solicitação',
                            type: 'red',
                            icon: 'fa fa-warning',
                            typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: 'Tentar novamente',
                                    btnClass: 'btn-gray',
                                    action: function(){
                                    }
                                },
                                Sair: function () {
                                    window.location.reload();
                                }
                            }
                        });
                        alert('Houve erros ao processar a solicitação, consulte o console.log'+data);

                    },
                });
            }
        }
        }
    });
}
</script>
@stop
