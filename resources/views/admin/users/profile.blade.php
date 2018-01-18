<!--Hereda del template Main -->
@extends ('admin.template.main') 
 
<!--Contenido a mostrar -->
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <img class="img_profile rounded-circle" width="100px" height="100px" src="{{ asset('uploads/avatars/'.$user->avatar) }}">
        <!--Imprime el nombre completo del usuario -->
        <h2>{{ $user->username }}</h2>
        <h4>Cambiar Avatar</h4>
        <!--Formulario para actualizar foto de perfil -->
        {{ Form::open(['route' => ['user.profile.update'], 'files' => true, 'method' => 'PATCH']) }}
          <div class="form-group">
            
            <br>
            <div class="custom-file">
              <!--Forma para subir archivos -->
              {{ Form::file('avatar', ['class' => 'image']) }}
            </div>
            <!--Botón Submit-->
            {{ Form::submit('Subir', ['name' => 'submit', 'class'=>'btn btn-success']) }}
            <br>
            <small class="text-muted">Tamaño Max: 2MB - Aceptable: .png, .jpb, .bmp  </small>
          </div>
        {{ Form::close() }}
    </div>
  </div>
</div>
@endsection