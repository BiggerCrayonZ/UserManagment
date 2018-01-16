<style>
  .text_right {
    text-align: right;
  }
</style>

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
          {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('user.profile') }}">Cambiar Foto de Perfil...</a>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">Cerrar Sesion</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>