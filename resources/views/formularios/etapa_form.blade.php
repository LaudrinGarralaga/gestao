@extends('layouts.principal')

@section('conteudo')

<div class="container">
    <div class='col-sm-11'>
        @if ($acao == 1)
        <h2> Fomulário de Etapas </h2>
        @else 
        <h2> Alteração de Etapas </h2>
        @endif
    </div>
    <div class='col-sm-1'>
        <a href='{{route('etapas.index')}}' class='btn btn-primary' 
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
    <form method="post" action="{{route('etapas.store')}}">
        @else 
        <form method="post" action="{{route('etapas.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i> Área</span>
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
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i> Fluxo</span>
                <select class="form-control" id="fluxo_id" name="fluxo_id">
                    @foreach ($fluxos as $fluxo)    
                    <option value="{{$fluxo->id}}" 
                            @if ((isset($reg) && $reg->fluxo_id==$fluxo->id) 
                            or old('fluxo_id') == $fluxo->id) selected @endif>
                            {{$fluxo->descricao}}</option>
                    @endforeach    
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </form>    
    </form>
</div>

@endsection




