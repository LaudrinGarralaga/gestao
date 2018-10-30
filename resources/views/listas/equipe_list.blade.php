@extends('adminlte::page')

@section('title', 'Lista de Equipes')

@section('content_header')
<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
    <div class="bred">
        <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Lista de Equipes</p> 
    </div>
</div>
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
<div class="box box-success">
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-6">
                    <div class="dataTables_length" id="example1_length"></div>
                </div>
                <div class="col-sm-6">
                    <div id="example1_filter" class="dataTables_filter"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Nome</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Área/Departamento</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Ações</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Responsável</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipes as $equipe) 
                                <tr>
                                    <td style="width: 20%"> {{$equipe->nome}} </td>
                                    <td style="width: 20%"> {{$equipe->area->sigla}} </td>
                                    <td style="width: 25%; text-align: center"> <a href='{{route('equipesmembros.create', $equipe->id)}}'
                                        class='btn btn-success' 
                                        role='button'> <span class="glyphicon glyphicon-plus"></span> Adicionar 
                                        </a>
                                        <a href='{{route('equipes.detalhes', $equipe->id)}}'
                                            class='btn btn-primary' 
                                            role='button'> <span class="glyphicon glyphicon-list"></span> Detalhes 
                                        </a>
                                        <a href='{{route('equipes.edit', $equipe->id)}}'
                                            class='btn btn-warning' 
                                            role='button'> <span class="glyphicon glyphicon-pencil"></span> Alterar 
                                        </a>
                                        <form style="display: inline-block"
                                            method="post"
                                            action="{{route('equipes.destroy', $equipe->id)}}"
                                            onsubmit="return confirm('Confirma Exclusão?')">
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Excluir </button>
                                        </form>                                
                                    </td>     
                                    <td style="width: 20%"> {{$equipe->user->name}} </td>                    
                                </tr>   
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        <ul class="pagination"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href='{{route('equipes.create')}}' class='btn btn-primary' role='button'><span class="glyphicon glyphicon-new-window"></span> Novo </a>

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

