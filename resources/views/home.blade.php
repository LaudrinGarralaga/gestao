@extends('adminlte::page')

@section('title', 'Principal')

@section('content_header')
<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
    <div class="bred">
        <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Home</p> 
    </div>
</div>
@stop

@section('content')
<div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$notificacao}}</h3>
                    <p>Notificações</p>
                </div>
                <div class="icon">
                    <i class="fa fa-bell-o"></i>
                </div>
                <a href='{{route('notificacoes.index')}}' class="small-box-footer">
                    Mais Infomações
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>     
    </div>
@stop