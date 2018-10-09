@extends('adminlte::page')

@section('title', 'Lista de Fluxos')

@section('content_header')
<h2>Lista de Fluxos</h2>
<p>Lista que mostra os fluxos existentens no sistema</p>
@stop

@section('content')

@if (session('status'))
<div class="container">
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('status') }}
    </div>
</div>
@endif

<div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Fluxos</h3>
        </div>
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_length" id="example1_length">
                            
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter">
                           
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Descrição</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fluxos as $fluxo) 
                                            <tr>
                                                <td> {{$fluxo->id}} </td>
                                                <td> {{$fluxo->descricao}} </td>
                                                <td>
                                                    <a href='{{route('fluxos.adicionar', $fluxo->id)}}'
                                                        class='btn btn-success' 
                                                        role='button'> <span class="glyphicon glyphicon-plus"></span> Adicionar 
                                                    </a>
                                                    <a href='{{route('fluxos.detalhes', $fluxo->id)}}'
                                                        class='btn btn-primary' 
                                                        role='button'> <span class="glyphicon glyphicon-list"></span> Detalhes 
                                                    </a> 
                                                    <a href='{{route('fluxos.edit', $fluxo->id)}}'
                                                        class='btn btn-warning' 
                                                        role='button'><i class="fa fa-pencil"></i> Alterar </a>
                                                        <form style="display: inline-block"
                                                        method="post"
                                                        action="{{route('fluxos.destroy', $fluxo->id)}}"
                                                        onsubmit="return confirm('Confirma Exclusão?')">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit"
                                                                class="btn btn-danger"><i class="fa fa-trash"></i> Excluir </button>
                                                        </form>                                      
                                                </td>
                                            </tr>
                                            
                                         @endforeach
                                    </tbody>
                                    <tfoot>
                                       
                                    </tfoot>
                            </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            <ul class="pagination"></ul>
                        </div>
                    </div>
                    <div class="col-sm-7">
                    </div>
                </div>
            </div>
        </div>
</div>
<a href='{{route('fluxos.create')}}' class='btn btn-primary' 
           role='button'><span class="glyphicon glyphicon-new-window"></span> Novo </a>
@stop

@section('js')

<script src="{{asset('https://code.jquery.com/jquery-3.3.1.js')}}"></script>
<script src="{{asset('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js')}}"></script> 

<script>
$(document).ready(function() {
    $('#example1').DataTable( {
        "language": { "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
}
} );
} );
</script>
@stop

@section('css')
    <link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel="stylesheet" href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css'>
@stop