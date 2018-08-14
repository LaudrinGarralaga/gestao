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
    <h2>Lista de Áreas</h2>
    <p>Lista que mostra as áreas existentens no sistema</p>    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Sigla</th>
                <th>Descrição</th>
                <th>Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($areas as $area) 
            <tr>
                <td> {{$area->id}} </td>
                <td> {{$area->sigla}} </td>
                <td> {{$area->descricao}} </td>
                <td> {{$area->user->name}} </td>
                <td> <a href='{{route('areas.edit', $area->id)}}'
                        class='btn btn-info' 
                        role='button'> <span class="glyphicon glyphicon-pencil"></span> Alterar 
                    </a>
                    <form style="display: inline-block"
                          method="post"
                          action="{{route('areas.destroy', $area->id)}}"
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
        <a href='{{route('areas.create')}}' class='btn btn-primary' 
           role='button'><span class="glyphicon glyphicon-new-window"></span> Novo </a>
    </div>
    {{ $areas->links() }}      
</div>

@endsection

