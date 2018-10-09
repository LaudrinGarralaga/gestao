@extends('adminlte::page')

@section('title', 'Cadastro de Atividade')

@section('content_header')
@foreach ($titulos as $titulo) 
<h2> {{$titulo->descricao}}: Cadastro de Atividade</h2>
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
    <div class="box box-primary">
            <div class="box-body">
    <form method="post" action="{{route('fluxoatividade.adicionarSalvar', $id)}}">
        @else 
        <div class="box box-primary">
                <div class="box-body">
        <form method="post" action="{{route('fluxos.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <div class="col-sm-4">
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
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="precedencia">Precedência:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </div>    
                            <input type="number" class="form-control" id="precedencia" 
                                name="precedencia" placeholder="Digite a precedencia"
                                value="{{$reg->precedencia or old('precedencia')}}"                   
                                required>
                        </div>
                    </div> 
                </div>
        </div>     
        </div>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </form>    
    </form>


@endsection


