@extends('layouts.principal')

@section('conteudo')

<div class="container">
    <div class='col-sm-11'>
        @if ($acao == 1)
        <h2> Fomulário de Permissões/Níveis </h2>
        @else 
        <h2> Alteração de Permissões/Níveis </h2>
        @endif
    </div>
    <div class='col-sm-1'>
        <a href='{{route('proles.index')}}' class='btn btn-primary' 
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
    <form method="post" action="{{route('proles.store')}}">
        @else 
        <form method="post" action="{{route('proles.update', $reg->id)}}">
            {!! method_field('put') !!}
            @endif
            {{ csrf_field() }}
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i> Permissão</span>
                <select class="form-control" id="permission_id" name="permission_id">
                    @foreach ($permissions as $permission)    
                    <option value="{{$permission->id}}" 
                            @if ((isset($reg) && $reg->permission_id==$permission->id) 
                            or old('permisson_id') == $permission->id) selected @endif>
                            {{$permission->name}}</option>
                    @endforeach    
                </select>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> Nível</span>
                <select class="form-control" id="role_id" name="role_id">
                    @foreach ($roles as $role)    
                    <option value="{{$role->id}}" 
                            @if ((isset($reg) && $reg->role_id==$role->id) 
                            or old('role_id') == $role->id) selected @endif>
                            {{$role->name}}</option>
                    @endforeach    
                </select>
            </div> 
            <br>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Salvar</button>
        </form>    
    </form>
</div>

@endsection


