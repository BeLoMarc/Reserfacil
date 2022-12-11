@extends('plantilla/plantilla')
@section('formulario')

    @if ($mensaje = Session::get('fail'))
        <div class="row">
            <div class="alert alert-warning" role="alert">
                {{ $mensaje }}
            </div>
        </div>
    @endif


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
        <p class="form__title">INICIO SESION</p>
        <form action="{{ route('cliente.autenticarCliente') }}" method="POST" enctype="multipart/form-data" id="Loggin">
            @csrf

            <div class="form__info">
                <label for="email" class="form__info__label">Correo electronico:</label>
                <input type="email" class="form__controls" id="correoLoggin" value="" name="email">
                <div id="malCorreoLoggin" class="invalid-feedback"></div>
            </div>
            <div class="form__info">
                <label for="password" class="form__info__label">Contraseña: <strong>*</strong>:</label>
                <input type="password" class="form__controls" id="contraseniaLoggin" value="" name="password">
                <div id="malContraseñaLoggin" class="invalid-feedback"></div>
            </div>

            <div class="form__info half">
                <input class="form__info__button" type="submit" value="INICIAR SESION" id="botonInicioSesion" />
            </div>
            <div class="form__info half">
                <a class="form__info__button other" href="{{ route('inicio.inicio') }}">Pagina Principal</a>
            </div>

        </form>
    </div>
    <script src="{{ asset('/JS/ValidarLoggin.js') }}"></script>
@endsection
