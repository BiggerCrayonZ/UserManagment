<!--Hereda del template Main -->
@extends ('admin.template.main')

<!--Contenido a mostrar -->
@section('content') 

  <div class="card">
      {{ Form::open(['route' => ['user.profile.update'], 'files' => true, 'method' => 'PATCH']) }}
    <img class="img_profile rounded-circle" width="100px" height="100px" src="{{ asset('uploads/avatars/'.$user->avatar) }}">
    <div class="card-body">
      <h4 class="card-title">{{ $user->username }}</h4>
      <p class="card-text">Cambiar Avatar</p>
      <div class="custom-file">
        <!--Forma para subir archivos -->
        {{ Form::file('avatar', ['class' => 'image']) }}
      </div>

      <!--Botón Submit-->
      {{ Form::submit('Subir', ['name' => 'submit', 'class'=>'btn btn-success']) }}
      <small class="text-muted">Tamaño Max: 2MB - Aceptable: .png, .jpb, .bmp </small>
    </div>
    {{ Form::close() }} 
  </div>

@endsection