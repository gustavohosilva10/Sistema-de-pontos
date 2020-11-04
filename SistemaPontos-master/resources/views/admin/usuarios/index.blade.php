@extends('adminlte::page')

@section('title', 'Sistema de pontos')

@section('content')

<div class="box">
    <div class="box-header with-border">
            <h3 class="box-title">Consultores</h3>
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
                    <th> Tipo </th>
                    <th> Nome </th>
                    <th> E-mail </th>
                    <th> Telefone </th>
                    <th> Função </th>
                    <th> Região </th>
                    <th></th>
                </tr>
            </thead>

        </table>

        <div class="box-footer">
            <a href="usuarios/novo" class="btn btn-default pull-right"> <i class="fas fa-plus"> </i> Novo usuário </a>
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
        ajax: '/admin/usuarios/tbl-json',
        columns: [
            { data: 'type', name: 'type' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'telephone', name: 'telephone' },
            { data: 'function', name: 'function' },
            { data: 'location_work', name: 'location_work' },
        ],
        "columnDefs": [
        { "targets": 0, "render": function (data, type, row) {


            t_user = row.type;

                switch(t_user){
                case 0:
                var tipo = "<span class='label label-default'>Administrador</span>";
                break;

                case '1':
                var tipo = "<span class='label label-primary'>Consultor</span>";
                break;

                }

            return tipo;
        }},
        { "targets": 6, "render": function (data, type, row) {

            html = "<a href='usuarios/"+row.id+"/editar' class='btn btn-default btn-xs btn-delete'> <i class='fas fa-edit'></i> </a> <button class='btn btn-danger btn-xs btn-delete' onclick=deletar("+row.id+")><i class='fa fa-trash'></i></button> </li>";
            return html;
        }
        }],
        'language': {
        "lengthMenu": "_MENU_ p/ página",
        "search": "Buscar: ",
        "loadingRecords": "Carregando...",
        "processing": "Processando...",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ usuários",
        "paginate": {
        "first":      "Primeiro",
        "last":       "Último",
        "next":       "Próximo",
        "previous":   "Anterior"
            },
        "zeroRecords":    "Opa, nenhuma usuário foi localizado.",
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
        content: 'Deseja mesmo deletar esse plano?',
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
                    url: '/admin/usuarios/'+id+'/deletar',
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
                                content: 'O usuário foi deletado com sucesso',
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

