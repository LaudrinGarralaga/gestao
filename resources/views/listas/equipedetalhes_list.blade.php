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
    <h2>Lista de Membros da Equipe</h2>
    <p>Lista que mostra os membros da equipe</p>    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Membro</th>
                <th>Equipe</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipemembros as $equipemembro) 
            <tr>
                <td> {{$equipemembro->id}} </td>
                <td> {{$equipemembro->user->name}} </td>
                <td> {{$equipemembro->equipe->nome}} </td>
                <td>
                    <form style="display: inline-block"
                          method="post"
                          action="{{route('equipesmembros.destroy', $equipemembro->id)}}"
                          onsubmit="return confirm('Confirma Exclusão?')">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <button type="submit"
                                class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Remover </button>
                    </form>  
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>    

    <div class='col-sm-12'>
        <a href='{{route('equipes.index')}}' class='btn btn-primary' 
           role='button'><span class="glyphicon glyphicon-arrow-left"></span> Voltar </a>
    </div>
</div>

@endsection


