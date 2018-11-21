@extends('layouts.principal')

@section('conteudo')

@if (session('status'))
<div class="container">
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('status') }}
    </div>
</div>
@endif

<div class='container'>
    <h2>Lista de Etapas</h2>
    <p>Lista que mostra as etapas existentens no sistema</p>    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Área</th>
                <th>Fluxo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($etapas as $etapa) 
            <tr>
                <td> {{$etapa->id}} </td>
                <td> {{$etapa->area->sigla}} </td>
                <td> {{$etapa->fluxo->descricao}} </td>
                <td style="width: 5%"> <a href='{{route('etapas.edit', $etapa->id)}}'
                                          class='btn btn-info' 
                                          role='button'> <span class="glyphicon glyphicon-pencil"></span>  
                    </a>
                    <form style="display: inline-block"
                          method="post"
                          action="{{route('etapas.destroy', $etapa->id)}}"
                          onsubmit="return confirm('Confirma Exclusão?')">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <button type="submit"
                                class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>  </button>
                    </form>                                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>    

    <div class='col-sm-12'>
        <a href='{{route('etapas.create')}}' class='btn btn-primary' 
           role='button'><span class="glyphicon glyphicon-new-window"></span> Novo </a>
    </div>
    {{ $etapas->links() }}      
</div>

@endsection



