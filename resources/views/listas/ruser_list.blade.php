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
    <h2>Lista de Níveis/Usuários</h2>
    <p>Lista que mostra os níveis associadas aos usuários existentens no sistema</p>    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Usuário</th>
                <th>Nível</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rusers as $ruser) 

            <tr>
                <td> {{$ruser->id}} </td>
                <td> {{$ruser->user->name}} </td>
                <td> {{$ruser->role->name}} </td>

                <td> <a href='{{route('rusers.edit', $ruser->id)}}'
                        class='btn btn-info' 
                        role='button'> <span class="glyphicon glyphicon-pencil"></span> Alterar 
                    </a>
                    <form style="display: inline-block"
                          method="post"
                          action="{{route('rusers.destroy', $ruser->id)}}"
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
        <a href='{{route('rusers.create')}}' class='btn btn-primary' 
           role='button'><span class="glyphicon glyphicon-new-window"></span> Novo </a>
    </div>
    {{ $rusers->links() }}   

</div>

@endsection



