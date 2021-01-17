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
            <a class="navbar-brand" href="#">Navbar</a>
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
                        <a class="nav-link {{ activeMenu('saludos*') }}" href="{{ route('saludos', 'Dimar') }}">Saludos</a>
                    </li>            
                    <li class="nav-item">
                        <a class="nav-link {{ activeMenu('mensajes/create') }}" href="{{ route('mensajes.create') }}">Contactos</a>
                    </li>
                    @if (auth()->check())
                        <li class="nav-item">
                            <a class="nav-link {{ activeMenu('mensajes') }}" href="{{ route('mensajes.index') }}">Mensajes</a>
                        </li>
                    @endif
                    
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

                <ul class="navbar-nav ml-auto mr-5 mt-2 mt-lg-0">

                    @if (auth()->check())
                        <li class="nav-item">
                            <a class="nav-link" 
                                href="/logout">Cerrar cesion de {{ auth()->user()->nombre }}
                            </a>
                        </li> 
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ activeMenu('login') }}" href="/login">Login</a>
                        </li> 
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Action 2</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container">
        @yield('contenido')

        <footer>
            <p>2020 - © Todos los derechos reservados</p>

        </footer>
    </div>

    
    <script src="/js/app.js"></script>
</body>
</html>