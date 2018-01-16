@extends ('admin.template.main') 
@section('title', 'Mostrar Usuario') 
@section('jumbotron', 'Usuario: ' . $user->username)
@section('content')
<style>
    .img_profile_view {
        width: 90%;
        padding: 10px;
    }

    .card_view {
        margin: 0 auto;
        /* Added */
        float: none;
        /* Added */
        margin-bottom: 10px;
        /* Added */
    }

    .card-block {
        margin: 10px;
    }
</style>
<div class="container-fluid">
    <div class="card card_view rounded-top " align="center" style="width:400px">
        <div class="center">
                <img class="img_profile_view img-thumbnail card-outline-success" src="{{ asset('uploads/avatars/'.$user->avatar) }}">
        </div>
        <div class="card-block">
            <h4 class="card-title">{{$user->name}} </h4>
        </div>
        <ul class="list-group list-group-flush">
            <small class="text-muted">Usuario: </small>
            <li class="list-group-item">
                <p class="card-text">{{$user->username}}</p>
            </li>
            <small class="text-muted">Correo Electronico: </small>
            <li class="list-group-item">{{$user->email}}</li>
            <small class="text-muted">Tipo de Usuario: </small>
            <li class="list-group-item">
                @if($user->member == 'admin')
                <span class="badge badge-warning">Administrador</span>
                @elseif ($user->member == 'member')
                <span class="badge badge-primary">Miembro</span>
                @endif
            </li>
            <small class="text-muted">Dirección: </small>
            <li class="list-group-item">{{$user->address}}</li>
            <small class="text-muted">Teléfono: </small>
            <li class="list-group-item">
                <h4 class="card-title"> " {{$user->phone}} " </h4>
            </li>
        </ul>
        <div class="card-footer">
            <small class="text-muted"> Creado: {{$user->created_at}}</small>
        </div>
    </div>
</div>

@endsection