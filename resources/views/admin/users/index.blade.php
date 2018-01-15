@extends ('admin.template.main')

@section('title', 'Lista de Usuarios')

@section('jumbotron', 'Lista de Usuarios: ')


@section('content')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    .table{
        font-size:12px;
    }
</style>

    <!--Renderizamos la tabla con todos los usuarios -->
    <table class="table table-striped">
        <thead class="thead-dark">
            <th>ID del Usuario: </th>
            <th>Alias o Nombre Común de Usuario: </th>
            <th>Nombre Completo:</th>
            <th>E-Mail:</th>
            <th>Tipo de Usuario:</th>
            <th>Acción:</th>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if($user->member == 'admin')
                        <span class="badge badge-warning">Administrador</span>
                        @elseif ($user->member == 'member')
                        <span class="badge badge-primary">Miembro</span>
                        @endif
                    </td>

                    <td>
                        <a href="" class="btn btn-warning">
                            <span class="fa fa-cog  fa-1">
                        </a> 
                        <a href="" class="btn btn-danger">                            
                            <span class="fa fa-times fa-1">
                        </a>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
    {{ $users-> links() }}

@endsection

@section('tool')

<style>
    .tool{
        margin-top:0px;
        margin-bottom:0px;
        margin-left:20px;
        margin-right:20px;
    }
</style>

<div class="card tool">
        <p class="card-header">Herramientas</p>
    <div class="card-block">
        <a href="{{ route('users.create') }}" class="btn btn-info btn-sm">Nuevo Usuario</a>
    </div>
</div>



@endsection