@extends('adminlte::page')

@section('title', 'Detalhes do Fluxo')

@section('content_header')
    @foreach ($fluxos as $fluxo) 
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Detalhes do Fluxo: {{$fluxo->descricao}}</p> 
            </div>
        </div>
    @endforeach
@stop

@section('content')

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
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Equipe</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Responsável</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Precedência</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Finalizado</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Finalizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fluxoatividades as $fluxoatividade) 
                                <tr>
                                    <td> {{$fluxoatividade->equipe->nome}} </td>
                                    @if(empty($fluxoatividade->equipe->user->name))
                                    <td> </td>
                                    @else 
                                    <td>{{$fluxoatividade->equipe->user->name}}</td>
                                    @endif
                                    <td> {{$fluxoatividade->precedencia}} </td>
                                    <td> @if($fluxoatividade->finalizado == 0)
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        @else
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                        @endif
                                    </td>
                                    <td style="width: 5%; text-align: center"> 
                                        <a href='{{route('fluxos.finalizar', $fluxoatividade->id)}}'
                                            class='btn btn-success' 
                                            role='button'> <span class="glyphicon glyphicon-ok"></span>  
                                        </a> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        <ul class="pagination"></ul>
                    </div>
                </div>
                <div class="col-sm-7"></div>
            </div>
        </div>
    </div>
</div>

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


