@extends('adminlte::page')

@section('title', 'Cadastro de Equipes')

@section('content_header')
@if ($acao == 1)
<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Cadastro de Equipes</p> 
        </div>
    </div>

@else 
<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Alteração de Equipes</p> 
        </div>
    </div>
  
@endif
@stop

@section('content')
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


    @if ($acao == 1)
    <div class="box box-success">
        <div class="box-body">
    <form method="post" action="{{route('equipes.store')}}">
        @else 
        <div class="box box-success">
            <div class="box-body">
        <form method="post" action="{{route('equipes.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="nome">Nome da Equipe:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-flag"></i>
                        </div>
                        <input type="text" class="form-control" id="nome" 
                            name="nome" placeholder="Digite o nome da equipe"
                            value="{{$reg->nome or old('nome')}}"
                            required>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="nome">Descrição da Equipe:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </div>
                        <input type="text" class="form-control" id="descricao" 
                            name="descricao" placeholder="Digite a descrição da equipe"
                            value="{{$reg->descricao or old('descricao')}}"                   
                            required>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="nome">Área:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-globe"></i>
                        </div>
                        <select class="form-control" id="area_id" name="area_id">
                            @foreach ($areas as $area)    
                            <option value="{{$area->id}}" 
                                    @if ((isset($reg) && $reg->area_id==$area->id) 
                                    or old('area_id') == $area->id) selected @endif>
                                    {{$area->sigla}}</option>
                            @endforeach    
                        </select>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-open"></span> Salvar</button>
    </form>    
</form>

@endsection


