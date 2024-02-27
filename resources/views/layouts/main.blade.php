<!DOCTYPE html>
<html lang="pt">
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body margin="0" class="d-flex flex-column align-items-center justify-items-center">
        <nav class="navbar w-100 navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                <img src="" alt="" class="d-inline-block align-text-top" />
                        marca
                </a>
            </div>
            <div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                    </li>
                </ul>
            </div>
        </nav>
        @yield('content')
        <footer class="footer mt-auto py-3 bg-dark text-white w-100">
            <div class="container text-center">
                <span>© 2024 - Todos os direitos reservados</span>
            </div>
    </body>
</html>
