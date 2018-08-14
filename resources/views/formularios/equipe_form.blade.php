@extends('layouts.principal')

@section('conteudo')

<div class="container">
    <div class='col-sm-11'>
        @if ($acao == 1)
        <h2> Fomulário de Equipes </h2>
        @else 
        <h2> Alteração de Equipes </h2>
        @endif
    </div>
    <div class='col-sm-1'>
        <a href='{{route('equipes.index')}}' class='btn btn-primary' 
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
    <form method="post" action="{{route('equipes.store')}}">
        @else 
        <form method="post" action="{{route('equipes.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                <input type="text" class="form-control" id="nome" 
                       name="nome" placeholder="Nome"
                       value="{{$reg->nome or old('nome')}}"
                       required>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                <input type="text" class="form-control" id="descricao" 
                       name="descricao" placeholder="Descrição"
                       value="{{$reg->descricao or old('descricao')}}"                   
                       required>
            </div> 
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i> Área</span>
                <select class="form-control" id="area_id" name="area_id">
                    @foreach ($areas as $area)    
                    <option value="{{$area->id}}" 
                            @if ((isset($reg) && $reg->area_id==$area->id) 
                            or old('area_id') == $area->id) selected @endif>
                            {{$area->sigla}}</option>
                    @endforeach    
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </form>    
    </form>
</div>

@endsection


