@extends('layouts.principal')

@section('conteudo')

<ul>
    <div class="container">
        @can('adm')
        <div class="col-sm-6" style="margin-bottom: 20px">
            <a href='{{route('users.index')}}' role="button" class="btn btn-success" style="width: 500px">
                Usuários Cadastrados <span class="badge badge-light">{{$totalUsers}}</span>
                <img src="user.png" class="rounded-circle" alt="Cinque Terre" width="100px">
            </a>
        </div>
        @endcan
        <div class="col-sm-6" style="margin-bottom: 20px">
            <a href='{{route('areas.index')}}' role="button" class="btn btn-success" style="width: 500px">
                Areas Cadastradas <span class="badge badge-light">{{$totalAreas}}</span>
                <img src="trabalho.png" class="rounded-circle" alt="Cinque Terre" width="100px">
            </a>
        </div>
        @can('adm')
        <div class="col-sm-6" style="margin-bottom: 20px">
            <a href='{{route('fluxos.index')}}' role="button" class="btn btn-info" style="width: 500px">
                Total de Fluxos <span class="badge badge-light">{{$totalFluxos}}</span>
                <img src="document.png" class="rounded-circle" alt="Cinque Terre" width="100px">
            </a>   
        </div>
        @else
        <div class="col-sm-6" style="margin-bottom: 20px">
            <a href="{{route('fluxos.index')}}" role="button" class="btn btn-info" style="width: 500px">
                Meus Fluxos <span class="badge badge-light">{{$totalFluxos}}</span>
                <img src="document.png" class="rounded-circle" alt="Cinque Terre" width="100px">
            </a>   
        </div>
        @endcan
        @can('adm')
        <div class="col-sm-6" style="margin-bottom: 20px">
            <a href='{{route('permissoes.index')}}' role="button" class="btn btn-primary" style="width: 500px">
                Total de Permissões <span class="badge badge-light">{{$totalPermissions}}</span>
                <img src="permission.png" class="rounded-circle" alt="Cinque Terre" width="100px">
                <br>
            </a>  
        </div>
        @endcan
        @can('adm')
        <div class="col-sm-6" style="margin-bottom: 20px">
            <a href='{{route('niveis.index')}}' role="button" class="btn btn-danger" style="width: 500px">
                Total de Níveis <span class="badge badge-light">{{$totalRoles}}</span>
                <img src="nivel.png" class="rounded-circle" alt="Cinque Terre" width="100px">
            </a>   
        </div>
        @endcan
    </div>
</ul>

@endsection
