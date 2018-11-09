@extends('adminlte::page')

@section('title', 'Cadastro de Fluxo')

@section('content_header')
    @if ($acao == 1)
    <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Cadastro de Sequências</p> 
            </div>
        </div>
       
    @else 
    <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Alteração de Sequências</p> 
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
    <form method="post" action="{{route('fluxos.store')}}">
        @else 
        <div class="box box-success">
            <div class="box-body">
                <form method="post" action="{{route('fluxos.update', $reg->id)}}">
                    {!! method_field('put') !!}
                    @endif
                    {{ csrf_field() }}
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="descricao">Descrição da Sequência:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-info"></i>
                                </div>    
                                <input type="text" class="form-control" id="descricao" 
                                    name="descricao" placeholder="Digite o descrição da sequência"
                                    value="{{$reg->descricao or old('descricao')}}"                   
                                    required>
                            </div>
                        </div>
                    </div>     
                    <div class="col-sm-7">      
                        <div class="form-group">                    
                                <label>Equipe/Precedência:</label>
                                <div class="form-group multiple-form-group input-group">
                                    <div class="input-group-btn input-group-select">
                                        <select class="form-control" id="equipe_id" name="equipe[]" style="width: 380px">
                                            @foreach ($equipes as $equipe)    
                                            <option value="{{$equipe->id}}" 
                                            @if ((isset($reg) && $reg->equipe_id==$equipe->id) 
                                            or old('equipe_id') == $equipe->id) selected @endif>
                                            {{$equipe->nome}}</option>
                                            @endforeach    
                                        </select>    
                                    </div>
                                    <input type="number" name="precedencia[]" class="form-control" placeholder="Precedência" style="width: 120px" min="1" max="99">
                                    &nbsp;
                                    <button type="button" class="btn btn-success btn-add">+</button>
                                </div>                    
                        </div>
                    </div>            
                </div>
            </div>     
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-open"></span> Salvar</button>       
        </form>
    </form>
@stop

@section('js')
<script src="{{asset('/js/myscripts.js')}}"></script>
@stop

@section('css')
<link href="{{asset('/css/main.css')}}" rel="stylesheet">
@stop



