@extends('layouts.principal')

@section('conteudo')

<div class="container">
    <div class='col-sm-11'>
        @if ($acao == 1)
        <h2> Inclusão de Membros na Equipe </h2>
        @else 
        <h2> Alteração de Membros da Equipe </h2>
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
    <form method="post" action="{{route('equipesmembros.store')}}">
        @else 
        <form method="post" action="{{route('equipesmembros.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}          
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> Membro</span>
                <select class="form-control" id="user_id" name="user_id" >
                    @foreach ($users as $user)    
                    <option value="{{$user->id}}" 
                            @if ((isset($reg) && $reg->user_id==$user->id) 
                            or old('user_id') == $user->id) selected @endif>
                            {{$user->name}}</option>
                    @endforeach    
                </select>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i> Equipe</span>
                <select class="form-control" id="equipe_id" name="equipe_id" >
                    @foreach ($equipes as $equipe)    
                    <option value="{{$equipe->id}}" 
                            @if ((isset($reg) && $reg->equipe_id==$equipe->id) 
                            or old('equipe_id') == $equipe->id) selected @endif>
                            {{$equipe->nome}}</option>
                    @endforeach    
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </form>    
    </form>
</div>
<script>
//$('#equipe_id option:not(:selected)').attr('disabled', true);
</script>
@endsection




