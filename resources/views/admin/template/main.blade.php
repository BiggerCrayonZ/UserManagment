<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--Titulos por anclaje Yield-->
    <title>@yield('title', 'Default') | Panel de Administración</title>
    <!--Anclaje con css de Bootstrap-->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>

    <style>
        .card{
            margin-left:75px;
            margin-right:75px;
            margin-bottom:175px;
        }
        .jumbotron_fail{
            padding-top:200px;
            text-align:center;
        }
        .img_profile{
            
        }
        
    </style>
    @if (Auth::guest())
    
        <div class="jumbotron jumbotron_fail ">
            <h1>Sesión no Iniciada</h1>
            <span class="fa fa-ban   fa-5x"></span>
            <p>Para acceder al portal, se requiere de haber iniciado sesión previamente.</p>
            <a href="{{ route('login') }}" class="btn btn-sucess">Acceder</a>
        </div>
    @else
        
        @include('admin.template.partials.nav')
        <!--Seccion Principal -->
        @yield('header')
        <!--Seccion de la Tabla y Contenido -->
        <section>
            <div class="card ">
                <div class="card-header bg-success text-white">@yield('jumbotron') </div>
                <div class="card-block">
                    @yield('tool')
                </div>
                <div class="card-block">
                    <div class="card-body">
                        <!--Obtenemos la paquetería para la resolución del emnsaje Flash-->
                        @include('flash::message')
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
    @endif

    <script src="{{ asset('plugins/jquery/jquery-3.2.1.js')}}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
            <div class="col-xs-12">
                <!--Footer Bottom-->
                <p class="text-xs-center">&copy; Copyright 2016 - City of Mexico.  All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>