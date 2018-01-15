<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--Titulos por anclaje Yield-->
    <title>@yield('title', 'Default') | User Managment</title>
    <!--Anclaje con css de Bootstrap-->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
</head>

<body>

    <!--Section Principal de la Pagina de Welcome -->
    <section>
        @yield('content')
    </section>

    <script src="{{ asset('plugins/jquery/jquery-3.2.1.js')}}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
</body>