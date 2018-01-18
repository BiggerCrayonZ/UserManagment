<!--Hereda del template Main -->
@extends ('admin.template.main')

<!--Titulo -->
@section('title', 'Editar Usuario')

<!--Texto de Barra de Panel de Contenido -->
@section('jumbotron', 'Editar al usuario: ' . $user->username)

<!--Contenido a mostrar -->
@section('content') 

<!--Formulario para editar usuarios -->
{!! Form::open(['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
<!--Tokens-->
{{ Form::token() }}

<div class="form-group">
    <!--Campo alias -->
    {!! Form::label('name', 'Alias: ') !!} {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' =>'Alias',
    'required']) !!}
    <small class="text-muted">Nombre que aparecerá cuando accedes al portal </small>
</div>

<div class="form-group">
    <!--Campo nombre -->
    {!! Form::label('username', 'Nombre: ') !!} {!! Form::text('username', $user->username, ['class' => 'form-control', 'placeholder'
    =>'Nombre Completo', 'required']) !!}
    <small class="text-muted">Incluyendo apellidos </small>
</div>

<div class="form-group">
    <!--Campo e-mail -->
    {!! Form::label('email', 'Correo-Electronico: ') !!} {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder'
    =>'example@domain.com', 'required']) !!}
    <small class="text-muted">Será tu ID de acceso al portal </small>
</div>

<div class="form-group">
    <!--Campo contraseña -->
    {!! Form::label('password', 'Contraseña: ') !!} {!! Form::password('password', ['minlenth' => 6, 'maxlength' => 10,'class'
    => 'form-control', 'placeholder' =>'*********', 'required']) !!}
    <small class="text-muted">Mínimo 6 carácteres y máximo 10. </small>
</div>

<div class="form-group">
    <!--Campo recaptura contraseña -->
    {!! Form::label('secondpass', 'Repita Contraseña: ') !!} {!! Form::password('secondpass', ['class' => 'form-control', 'placeholder'
    =>'*********', 'required']) !!}
</div>

<div class="form-group">
    <!--Selector de tipos de usuarios -->
    {!! Form::label('member', 'Tipo: ') !!} {!! Form::select('member', ['member' => 'Miembro', 'admin' => 'Administrador'], null,
    ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <!--Campo dirección -->
    {!! Form::label('address', 'Dirección: ') !!} {!! Form::text('address', $user->address, ['maxlength' => 30,'class' => 'form-control',
    'placeholder' =>'Ejemplo: Avenida No. , Colonia , Ciudad', 'required']) !!}
    <small class="text-muted">Máximo 30 carácteres. </small>
</div>

<div class="form-group">
    <!--Campo Teléfono -->
    {!! Form::label('phone', 'Telefono: ') !!} {!! Form::number('phone', $user->phone, ['class' => 'form-control', 'placeholder'
    =>'1-(555)-5555-5555']) !!}
    <small class="text-muted">Máximo 10 carácteres </small>
</div>

<div class="form-group">
    {!! Form::submit('Editar', ['class'=>'btn btn-success']) !!}
</div>

{!! Form::close() !!} 
@endsection