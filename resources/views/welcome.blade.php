@extends('admin.template.main') @section('title', 'Home') @section('principal')

<head>
    <style>
        .bg-1 {
            
            /* Green */
            color: #000000;
        }

        .container-fluid {
            padding-top: 70px;
            padding-bottom: 200px;
        }
    </style>
</head>

<body>
    <div class="container-fluid bg-1 text-center">
        <img src="{{asset('icons/um_launcher/res/mipmap-xxxhdpi/um_launcher.png')}}" alt="UM">
        <h4>User Managment</h4>
    </div>
</body>
@endsection