<!--Hereda del template Main -->
@extends ('admin.template.main') 

<!--Titulo -->
@section('title', 'Lista de Usuarios') 

<!--Texto de Barra de Panel de Contenido -->
@section('jumbotron', 'Lista de Usuarios: ')

<!--Contenido a de la cabecera -->
@section('header')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Bienvenido</h1> 
        <p>Crear, editar, visualizar y eliminar usuarios, nunca fue tan facil.</p> 
    </div>
</div>

@endsection

<!--Contenido a mostrar -->
@section('content')


<style>
    .table {
        font-size: 12px;
    }
</style>

<!--Renderizamos la tabla con todos los usuarios -->
<div class="table-responsive-xl">
    <table class="table table-striped">
        <thead class="thead-dark">
            <th>Profile: </th>
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
                <td>
                    <img class="img_profile rounded-circle" width="30px" height="30px" src="{{ asset('uploads/avatars/'.$user->avatar) }}">
                </td>
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
                    <a href="{{  route('users.show', $user->id) }}"
                        class="btn btn-primary">
                        <span class="fa fa-eye fa-1">
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" 
                        class="btn btn-warning">
                        <span class="fa fa-cog  fa-1">
                    </a>
                    <a href="{{  route('admin.users.destroy', $user->id) }}" 
                        onclick="return confirm('¿Seguro que deseas eliminar este usuario?')"
                        class="btn btn-danger">
                        <span class="fa fa-times fa-1">
                    </a>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!! $users->render() !!} 
@endsection 
@section('tool')

<style>
    .tool {
        margin-top: 0px;
        margin-bottom: 0px;
        margin-left: 20px;
        margin-right: 20px;
    }
</style>

<div class="card tool">
    <p class="card-header">Herramientas</p>
    <div class="card-block">
        <!--Botón para nuevos usuarios -->
        <a href="{{ route('users.create') }}" class="btn btn-info btn-sm">Nuevo Usuario</a>
    </div>
</div>



@endsection