@extends('layouts.principal')

@section('conteudo')

<div class="container">
    <div class='col-sm-11'>
        @if ($acao == 1)
        <h2> Fomulário de Permissões </h2>
        @else 
        <h2> Alteração de Permissões </h2>
        @endif
    </div>
    <div class='col-sm-1'>
        <a href='{{route('permissoes.index')}}' class='btn btn-primary' 
           role='button'><span class="glyphicon glyphicon-arrow-left"></span> Voltar </a>
    </div>
</div>

<div class="col-sm-12">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif    
</div>

<div class='container'>
    @if ($acao == 1)
    <form method="post" action="{{route('permissoes.store')}}">
        @else 
        <form method="post" action="{{route('permissoes.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                <input type="text" class="form-control" id="name" 
                       name="name" placeholder="Sigla"
                       value="{{$reg->name or old('name')}}"
                       required>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                <input type="text" class="form-control" id="label" 
                       name="label" placeholder="Descrição"
                       value="{{$reg->label or old('label')}}"                   
                       required>
            </div> 
            <br>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </form>    
    </form>
</div>

@endsection

