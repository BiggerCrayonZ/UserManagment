<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--Titulos por anclaje Yield-->
    <title>@yield('title', 'Default') | Panel de Administración</title>
    <!--Anclaje con css de Bootstrap-->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
</head>

<body>

    <style>
        .card{
            margin:75px;
        }
        
    </style>
    @include('admin.template.partials.nav')

    <!--Seccion Principal -->
    <section>
        <div class="card ">
            <div class="card-header bg-success text-white">@yield('jumbotron') </div>
            <div class="card-block">
                @yield('tool')
            </div>
            <div class="card-block">
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('plugins/jquery/jquery-3.2.1.js')}}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
</body>

</html>