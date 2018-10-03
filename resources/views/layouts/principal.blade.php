<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Gestão de Fluxos</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    </head>
    <body>

        <nav class="nav-side-menu">
            <div class="menu-list"> 
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Gestão de Fluxos</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{route('home')}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-plus-sign"></span> Cadastros <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @can('adm')
                                <li><a href="{{route('niveis.index')}}"><span class="glyphicon glyphicon-user"></span> Níveis</a></li>
                                <li><a href="{{route('permissoes.index')}}"><span class="glyphicon glyphicon-lock"></span> Permissões</a></li>
                            @endcan
                            <li><a href="{{route('fluxos.index')}}"><span class="glyphicon glyphicon-folder-open"></span> Fluxos</a></li>
                            <li><a href="{{route('areas.index')}}"><span class="glyphicon glyphicon-globe"></span> Áreas</a></li>
                            <li><a href="{{route('equipes.index')}}"><span class="glyphicon glyphicon-flag"></span> Equipes</a></li>
                        </ul>
                    </li>
                    @can('adm')
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cog"></span> Configurações de Acesso <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('rusers.index')}}"><span class="glyphicon glyphicon-user"></span> Nível/Usuário</a></li>
                                <li><a href="{{route('proles.index')}}"><span class="glyphicon glyphicon-lock"></span> Permissão/Nível</a></li>
                            </ul>
                        </li>
                    @endcan
                    <li class="active"><a href="{{route('etapas.index')}}"><span class="glyphicon glyphicon-list-alt"></span> Etapa</a></li>
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }} </a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <span class="glyphicon glyphicon-log-in"></span> Sair
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>                        
                    </li>
                </ul>  
            </div>
        </nav>

        <main class="py-4">
            @yield('conteudo')

        </main>
    </body>

</html>
