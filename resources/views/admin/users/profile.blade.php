<!--Hereda del template Main -->
@extends ('admin.template.main')

<!--Contenido a mostrar -->
@section('content')
<style>
  
  .card_edit{
    margin: 0 auto;
    /* Añadido */
    float: none;
    /* Añadido */
    margin-bottom: 10px;
    /* Añadido */
  }
  .img_profile_edit{
    max-width: 300px;
    padding:10px;
  }
</style>

<div class="container-fluid">
  <div class="card card_view rounded-top" align="center" style="width:400px">
      {{ Form::open(['route' => ['user.profile.update'], 'files' => true, 'method' => 'PATCH']) }}
    <div class="center">
        <img class="img_profile_edit card_edit rounded-circle" src="{{ asset('uploads/avatars/'.Auth::user()->avatar) }}">
    </div>
    <div class="card-block">
        <!--Alias del Usuario -->
        <h4 class="card-title">{{ $user->username }}</h4>
    </div>
    <ul class="list-group list-group-flush">
        <p class="card-text">Cambiar Avatar</p>
        <li class="list-group-item">
            {{ Form::file('avatar', ['class' => 'image']) }}
        </li>
        <!--Botón Submit-->
        <li class="list-group-item">
            {{ Form::submit('Subir', ['name' => 'submit', 'class'=>'btn btn-success btn-block']) }}
        </li>
        <div class="card-footer">
            Tamaño Max: 2MB - Aceptable: .png, .jpb, .bmp 
        </div>
    </ul>
    {{ Form::close() }}
  </div>
</div>


</div>

@endsection