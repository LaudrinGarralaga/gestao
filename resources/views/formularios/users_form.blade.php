@extends('adminlte::page')

@section('title', 'Cadastro de Usuários')

@section('content_header')
@if ($acao == 1)
<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Cadastro de Usuários</p> 
        </div>
    </div>
@else 
<div class="row" style="background-color: white; margin-top: -15px; height: 55px">
        <div class="bred">
            <p style="font-family: Arial; font-size: 20px; color: darkcyan; margin-left: 20px; margin-top: 15px">Alteração de Usuários</p> 
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
<div class="col-sm-4">
    @if ($acao == 1)
        <div class="box box-success">
            <div class="box-body">
        <form method="post" action="{{route('users.store')}}">
            @else 
            <div class="box box-success">
                <div class="box-body">
            <form method="post" action="{{route('users.update', $reg->id)}}">
                {!! method_field('put') !!}
                @endif
                {{ csrf_field() }}
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="name">Nome do Usuário:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" id="name" 
                                name="name" placeholder="Digite o nome do usuário"
                                value="{{$reg->name or old('name')}}"
                                required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="email">Email do Usuário:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </div>    
                            <input type="email" class="form-control" id="email" 
                                name="email" placeholder="Digite o email do usuário"
                                value="{{$reg->email or old('email')}}"                   
                                required>
                        </div>
                    </div> 
                </div>
                <div class="col-sm-12">
                        <div class="form-group">
                            <label for="password">Senha do Usuário:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </div>    
                                <input type="password" class="form-control" id="password" 
                                    name="password" placeholder="Digite a senha do usuário"
                                    value="{{$reg->password or old('password')}}"                   
                                    required>
                            </div>
                        </div> 
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="nome">Equipe:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-globe"></i>
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
            </div>
            <div class="col-sm-6"></div>
        </div>   
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button> 
    </form>    
</form>
            </div>

@stop