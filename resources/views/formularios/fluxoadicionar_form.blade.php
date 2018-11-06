@extends('adminlte::page')

@section('title', 'Cadastro de Atividade')

@section('content_header')
@foreach ($titulos as $titulo) 
<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Cadastro de Atividade do fluxo > {{$titulo->descricao}}</p> 
        </div>
    </div>
@endforeach
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
    <form method="post" action="{{route('fluxoatividade.adicionarSalvar', $id)}}">
        @else 
        <div class="box box-success">
                <div class="box-body">
        <form method="post" action="{{route('fluxos.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="col-sm-10">
                    <div class="form-group">
                        <label for="nome">Equipe:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </div>
                            <select class="form-control" id="equipe_id" name="equipe_id">
                                @foreach ($equipes as $equipe)    
                                <option value="{{$equipe->id}}" 
                                    @if ((isset($reg) && $reg->equipe_id==$equipe->id) 
                                    or old('equipe_id') == $equipe->id) selected @endif>
                                    {{$equipe->nome}}</option>
                                @endforeach    
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="precedencia">Precedência:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </div>    
                            <input type="number" class="form-control" id="precedencia" 
                                name="precedencia" placeholder="Digite a precedência"
                                value="{{$reg->precedencia or old('precedencia')}}"                   
                                required min="1" max="99">
                        </div>
                    </div> 
                </div>
        </div>     
        </div>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-open"></span> Salvar</button>
        </form>    
    </form>


@endsection


