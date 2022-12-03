@extends('plantilla/plantilla')
@section('formulario')
    <div class="row">
        <div class="col-sm-12">
            @if ($mensaje = Session::get('fail'))
                <div class="alert alert-warning" role="alert">
                    {{ $mensaje }}
                </div>
            @endif
        </div>
    </div>

    <!-- es la url donde llamo al store de restaurantes-->
    <div class="form">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <p>Corrige los siguientes errores:</p>
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data" id="crearCliente">
            @csrf
            <div class="form__info">
                <label for="Nombre" class="form__info__label">Nombre:</label>
                <input type="text" class="form__controls" placeholder="Nombre del usuario" value="" name="nombre"
                    id="nombreCliente">
                <div id="malNombreCliente" class="invalid-feedback"></div>

            </div>
            <div class="form__info">
                <label for="email" class="form__info__label">Correo electronico:</label>
                <input type="email" class="form__controls" value="" name="email" id="correoCliente"
                    placeholder="Usuario@liamg.com">
                <div id="malCorreoCliente" class="invalid-feedback"></div>

            </div>
            <div class="form__info">
                <label for="password" class="form__info__label">Contraseña:</label>
                <input type="password" class="form__controls" value="" name="password" id="contraseñaCliente"
                    placeholder="Contraseña">
                <div id="malContraseñaCliente" class="invalid-feedback"></div>

            </div>
            <div class="form__info">
                <label for="telefono" class="form__info__label">Telefono:</label>
                <input type="text" class="form__controls" placeholder="XXXXXXXXX" value="" name="telefono"
                    id="telefonoCliente">
                <div id="malTelefonoCliente" class="invalid-feedback"></div>

            </div>
            <div class="form__info half">
                <input id="botonCrearCliente" class="form__info__button" type="submit" value="Registrarse" />
            </div>
            <div class="form__info half">
                <a class="form__info__button other" href="{{ route('inicio.inicio') }}">pagina principal</a>
            </div>
        </form>
    </div>
    <script src="{{ asset('/JS/ValidarCrearCliente.js') }}"></script>
@endsection
