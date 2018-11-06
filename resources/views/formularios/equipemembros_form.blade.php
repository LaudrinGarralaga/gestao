@extends('adminlte::page')

@section('title', 'Cadastro de Membros da Equipe')

@section('content_header')
@if ($acao == 1)
@foreach ($titulos  as $titulo) 
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Inclusão de Membros na Equipe > {{$titulo->nome}}</p> 
            </div>
        </div>
    @endforeach
@else 
@foreach ($titulos  as $titulo) 
        <div class="row" style="background-color: white; margin-top: -15px; height: 55px">
            <div class="bred">
                <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Alteração de Membros da Equipe > {{$titulo->nome}}</p> 
            </div>
        </div>
    @endforeach
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
    <form method="post" action="{{route('equipesmembros.store')}}">
        @else 
        <div class="box box-primary">
            <div class="box-body">
        <form method="post" action="{{route('equipesmembros.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}          
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="nome">Membro:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <select class="form-control" id="user_id" name="user_id" >
                            @foreach ($users as $user)    
                            <option value="{{$user->id}}" 
                                    @if ((isset($reg) && $reg->user_id==$user->id) 
                                    or old('user_id') == $user->id) selected @endif>
                                    {{$user->name}}</option>
                            @endforeach    
                        </select>
                    </div>
                    <input type="text" id="equipe_id" name="equipe_id" value="{{$registro->id}}" style="display:none">
                </div>
            </div>
           
        </div>
        </div>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-open"></span> Salvar</button>
        </form>    
    </form>

@stop




