<!--Hereda del template Main -->
@extends ('admin.template.main') 

<!--Titulo -->
@section('title', 'Crear Usuario') 

<!--Texto de Barra de Panel de Contenido -->
@section('jumbotron', 'Crea un Usuario: ') 

<!--Contenido a mostrar -->
@section('content')

<style>
    .card {
        margin: auto;
        width: 50%;
    }
</style>

<!--Formulario para crear usuarios -->
{!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
<!--Tokens-->
{{ Form::token() }}
<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <div class="form-group">
            <!--Campo alias -->
            {!! Form::label('name', 'Alias: ') !!} {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' =>'Alias',
            'required']) !!}
            <small class="text-muted">Nombre que aparecerá cuando accedes al portal </small>
        </div>
    </li>
    <li class="list-group-item">
        <div class="form-group">
            <!--Campo nombre -->
            {!! Form::label('username', 'Nombre: ') !!} {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' =>'Nombre Completo', 'required']) !!}
            <small class="text-muted">Incluyendo apellidos </small>
        </div>
    </li>
    <li class="list-group-item">
        <div class="form-group">
            <!--Campo e-mail -->
            {!! Form::label('email', 'Correo-Electronico: ') !!} {!! Form::email('email', null, ['class' => 'form-control', 'placeholder'=>'example@domain.com', 'required']) !!}
            <small class="text-muted">Será tu ID de acceso al portal </small>
        </div>
    </li>
    <li class="list-group-item">
        <div class="form-group">
            <!--Campo contraseña -->
            {!! Form::label('password', 'Contraseña: ') !!} {!! Form::password('password', ['minlenth' => 6, 'maxlength' => 10 ,'class'=> 'form-control', 'placeholder' =>'*********', 'required']) !!}
            <small class="text-muted">Mínimo 6 carácteres y máximo 10. </small>
        </div>
    </li>
    <li class="list-group-item">
        <div class="form-group">
            <!--Campo recaptura contraseña -->
            {!! Form::label('secondpass', 'Repita Contraseña: ') !!} {!! Form::password('secondpass', ['class' => 'form-control', 'placeholder'=>'*********', 'required']) !!}
        </div>
    </li>
    <li class="list-group-item">
    </li>
    <li class="list-group-item">
    </li>
    <li class="list-group-item">
    </li>
    <li class="list-group-item">
    </li>    
</ul>



<div class="form-group">
    <!--Selector de tipos de usuarios -->
    {!! Form::label('member', 'Tipo: ') !!} {!! Form::select('member', ['member' => 'Miembro', 'admin' => 'Administrador'], null,
    ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <!--Campo dirección -->
    {!! Form::label('address', 'Dirección: ') !!} {!! Form::text('address', null, ['maxlength' => 30, 'class' => 'form-control',
    'placeholder' =>'Ejemplo: Avenida No. , Colonia , Ciudad', 'required']) !!}
    <small class="text-muted">Máximo 30 carácteres. </small>
</div>

<div class="form-group">
    <!--Campo Teléfono -->
    {!! Form::label('phone', 'Telefono: ') !!} {!! Form::number('phone', null, [ 'class' => 'form-control', 'placeholder' =>'1-(555)-5555-5555'])!!}
    <small class="text-muted">Máximo 10 carácteres </small>
</div>
<small class="text-muted"></small>
<br>


<div class="form-group">
    <!--Boton de Registro -->
    {!! Form::submit('Registrar', ['class'=>'btn btn-success']) !!}
</div>

{!! Form::close() !!} 
@endsection

@section('footer', 'La foto de perfíl será editada una vez la cuenta esté creada. Deberá dirigirse a la barra de navegación, hacer click en su "Nombre de usuario", y seleccionar "Cambiar Foto de Perfil".')