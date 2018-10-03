@extends('adminlte::page')

@section('title', 'Cadastro de Fluxo')

@section('content_header')
@if ($acao == 1)
    <h2> Cadastro de Fluxos </h2>
@else 
    <h2> Alteração de Fluxos </h2>
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
    <div class="box box-primary">
            <div class="box-body">
    <form method="post" action="{{route('fluxos.store')}}">
        @else 
        <div class="box box-primary">
                <div class="box-body">
        <form method="post" action="{{route('fluxos.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                <input type="text" class="form-control" id="descricao" 
                       name="descricao" placeholder="Descrição"
                       value="{{$reg->descricao or old('descricao')}}"                   
                       required>
            </div>
        </div>     
        </div>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </form>    
    </form>


@endsection


