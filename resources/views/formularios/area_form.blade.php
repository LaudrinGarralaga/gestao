@extends('adminlte::page')

@section('title', 'Cadastro de Áreas')

@section('content_header')
@if ($acao == 1)
<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Cadastro de Áreas/Departamentos</p> 
        </div>
    </div>
@else 
<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Alteração de Áreas/Departamentos</p> 
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
        <form method="post" action="{{route('areas.store')}}">
            @else 
            <div class="box box-success">
                <div class="box-body">
            <form method="post" action="{{route('areas.update', $reg->id)}}">
                {!! method_field('put') !!}
                @endif
                {{ csrf_field() }}
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="nome">Nome da Área/Departamento:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </div>    
                            <input type="text" class="form-control" id="nome" 
                                name="nome" placeholder="Digite o nome da área"
                                value="{{$reg->nome or old('nome')}}"                   
                                required>
                        </div>
                    </div> 
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="nome">Sigla da Área:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </div>
                            <input type="text" class="form-control" id="sigla" 
                                name="sigla" placeholder="Digite a sigla da área"
                                value="{{$reg->sigla or old('sigla')}}"
                                required>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-open"></span> Salvar</button> 
    </form>    
</form>

@stop


