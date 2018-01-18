<style>
  .text_right {
    text-align: right;
  }
</style>
<!--Barra de Navegación -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <a class="navbar-brand" href="{{ route('users.index') }}">User Managment</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse text_right" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="navbar-brand" href="#">
          <img class="img_profile rounded-circle" width="30px" height="30px" src="{{ asset('uploads/avatars/'.Auth::user()->avatar) }}">
        </a>
        <a class="navbar-brand nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          <!--Imprime, desde Auth, el campo de nombre -->
          {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu">
          <!--Ruta para cambiar la foto de perfil -->
          <a class="dropdown-item" href="{{ route('user.profile') }}">Cambiar Foto de Perfil...</a>
          <!--Ruta para salir de sesión -->
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">Cerrar Sesion</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            <!--Validador csrf -->
            {{ csrf_field() }}
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>