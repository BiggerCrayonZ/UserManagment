@extends ('admin.template.main')

@section('title', 'Crear Usuario')

@section('jumbotron', 'Crea un Usuario: ')

@section('content')

    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Alias: ') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' =>'Alias', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('username', 'Nombre: ') !!}
            {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' =>'Nombre Completo', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Correo-Electronico: ') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' =>'example@domain.com', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Contraseña: ') !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' =>'*********', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('member', 'Tipo: ') !!}
            {!! Form::select('member', ['member' => 'Miembro', 'admin' => 'Administrador'], null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Registrar', ['class'=>'btn btn-success']) !!}
        </div>

    {!! Form::close() !!}

@endsection