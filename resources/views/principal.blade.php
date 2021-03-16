<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Datos interesantes">
    <meta name="author" content="Alex Brandon">
    <meta name="keyword" content="Datos interesantes">
    <link rel="shortcut icon" href="img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sandìas Què?</title>

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app">
        @include('header')

        <div class="app-body">
            <!-- Contenido Principal -->
            @yield('contenido')
            <!-- /Fin del contenido principal -->
        </div>
    </div>
    

    <footer class="app-footer">
        <span>&copy; 2020</span>
        <span class="ml-auto">Desarrollado por Alex y Brandon</a></span>
    </footer>
    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
</body>

</html>