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
    <h2>Lista de Níveis</h2>
    <p>Lista que mostra os níveis de usuários existentens no sistema</p>    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Sigla</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($niveis as $nivel) 
            @can('View_Nivel', $nivel)
            <tr>
                <td> {{$nivel->id}} </td>
                <td> {{$nivel->name}} </td>
                <td> {{$nivel->label}} </td>
                <td> <a href='{{route('niveis.edit', $nivel->id)}}'
                        class='btn btn-info' 
                        role='button'> <span class="glyphicon glyphicon-pencil"></span> Alterar 
                    </a>
                    <form style="display: inline-block"
                          method="post"
                          action="{{route('niveis.destroy', $nivel->id)}}"
                          onsubmit="return confirm('Confirma Exclusão?')">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <button type="submit"
                                class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Excluir </button>
                    </form>                                
                </td>
            </tr>
            @endcan

            @empty
        <p>Nenhum registro encontrado</p>
        @endforelse
        </tbody>
    </table>    

    <div class='col-sm-12'>
        <a href='{{route('niveis.create')}}' class='btn btn-primary' 
           role='button'><span class="glyphicon glyphicon-new-window"></span> Novo </a>
    </div>

    {{ $niveis->links() }}      
</div>

@endsection
