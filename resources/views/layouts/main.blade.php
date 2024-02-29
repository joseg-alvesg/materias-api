<!DOCTYPE html>
<html lang="pt">
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body margin="0" class="d-flex flex-column align-items-center justify-items-center position-relative">
        <nav class="navbar w-100 navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                <img src="" alt="" class="d-inline-block align-text-top" />
                        marca
                </a>
            </div>
            <div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link text-decoration-underline" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        @auth
                        <a class="nav-link text-decoration-underline" href="/materias/create">Criar</a>
                        @endauth
                        @guest
                        <a class="nav-link text-decoration-underline" href="/login">Criar</a>
                        @endguest
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-decoration-underline" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-underline" href="/register">Registrar</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item">
                        <a class="nav-link text-decoration-underline" href="/dashboard">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <form action="/logout" method="post">
                            @csrf
                            <a class="nav-link text-decoration-underline" href="/logout" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-underline" href="/user/dash">Dashboard</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        @yield('content')
        <footer class="footer mt-auto py-2 bg-dark text-white w-100 fixed-bottom">
            <div class="container text-center">
                <span>© 2024 - Todos os direitos reservados</span>
                <span class="inline-block float-end rounded">
                    <a href="#" class="text-white-50 text-decoration-none">top</a>
                </span>
            </div>
        </footer>
    </body>
</html>
