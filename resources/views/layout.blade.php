<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <title>Geotaxi</title>
</head>
<body>
    
    <header>
        <?php function activeMenu($url){
            return request()->is($url) ? 'active' : '';
        } ?>

        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            
            <a class="navbar-brand" href="{{ route('home') }}"><img src="/img/logo.png" alt="" style="width:60px;height:60px;"> Geotaxi</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ activeMenu('/') }}" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ activeMenu('mensajes/create') }}" href="{{ route('mensajes.create') }}">Contactos</a>
                    </li>
                    @if (auth()->check())
                            <li class="nav-item {{ activeMenu('mensajes') }}">
                                <a class="nav-link" href="{{ route('mensajes.index') }}">Mensajes</a>
                            </li>
                        @if (auth()->user()->hasRoles(['admin']) )
                            <li class="nav-item {{ activeMenu('usuarios*') }}">
                                <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                            </li>
                        @endif
                    @endif
                    
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

                <ul class="navbar-nav ml-auto mr-5 mt-2 mt-lg-0">

                    @if (auth()->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->nombre }}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="/logout">Cerrar cesion</a>
                                <a class="dropdown-item" href="/usuarios/{{ auth()->id() }}/edit">Mi cuenta</a>
                            </div>
                        </li>
                        
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ activeMenu('pasajeros*') }}" href="{{ route('pasajeros.create') }}">Regístrate</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link {{ activeMenu('login') }}" href="/login">Login</a>
                        </li> 
                    @endif

                    
                </ul>
            </div>
        </nav>
    </header>

    <div class="container">
        @yield('contenido')

        <footer>
            <p>2021 - © Todos los derechos reservados</p>

        </footer>
    </div>

    
    <script src="/js/app.js"></script>
</body>
</html>