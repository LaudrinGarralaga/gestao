@extends('layouts.principal')

@section('conteudo')

<ul>
    <div class="container">
        <div class="col-sm-6" style="margin-bottom: 20px">
            <button type="button" class="btn btn-success" style="width: 500px">
                Usuários Cadastrados <span class="badge badge-light">{{11}}</span>
                <img src="user.png" class="rounded-circle" alt="Cinque Terre" width="100px">
            </button>
        </div>
        <div class="col-sm-6" style="margin-bottom: 20px">
            <button type="button" class="btn btn-info" style="width: 500px">
                Total de Fluxos <span class="badge badge-light">{{11}}</span>
                <img src="document.png" class="rounded-circle" alt="Cinque Terre" width="100px">
            </button>   
        </div>
        <div class="col-sm-6" style="margin-bottom: 20px">
            <button type="button" class="btn btn-primary" style="width: 500px">
                Total de Permissões <span class="badge badge-light">{{11}}</span>
                <img src="permission.png" class="rounded-circle" alt="Cinque Terre" width="100px">
                <br>
            </button>  
        </div>
        <div class="col-sm-6" style="margin-bottom: 20px">
            <button type="button" class="btn btn-danger" style="width: 500px">
                Total de Níveis <span class="badge badge-light">{{11}}</span>
                <img src="nivel.png" class="rounded-circle" alt="Cinque Terre" width="100px">
            </button>   
        </div>
    </div>
</ul>
@endsection
