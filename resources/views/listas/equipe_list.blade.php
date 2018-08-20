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
    <h2>Lista de Equipes</h2>
    <p>Lista que mostra as equipes existentens no sistema</p>    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Área</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipes as $equipe) 
            <tr>
                <td> {{$equipe->id}} </td>
                <td> {{$equipe->descricao}} </td>
                <td> {{$equipe->area->sigla}} </td>
                <td><a href='{{route('equipesmembros.create', $equipe->id)}}'
                       class='btn btn-success' 
                       role='button'> <span class="glyphicon glyphicon-plus"></span> Adicionar 
                    </a>
                    <a href='{{route('equipes.detalhes', $equipe->id)}}'
                       class='btn btn-primary' 
                       role='button'> <span class="glyphicon glyphicon-list"></span> Detalhes 
                    </a>
                    <a href='{{route('equipes.edit', $equipe->id)}}'
                       class='btn btn-info' 
                       role='button'> <span class="glyphicon glyphicon-pencil"></span> Alterar 
                    </a>
                    <form style="display: inline-block"
                          method="post"
                          action="{{route('equipes.destroy', $equipe->id)}}"
                          onsubmit="return confirm('Confirma Exclusão?')">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <button type="submit"
                                class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Excluir </button>
                    </form>                                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>    

    <div class='col-sm-12'>
        <a href='{{route('equipes.create')}}' class='btn btn-primary' 
           role='button'><span class="glyphicon glyphicon-new-window"></span> Novo </a>
    </div>
    {{ $equipes->links() }}      
</div>

@endsection

