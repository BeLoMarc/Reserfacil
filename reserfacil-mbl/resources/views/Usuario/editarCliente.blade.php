@extends('plantilla/plantilla')
@section('formulario')
    <!-- NO SE PUEDE PONER UN ARCHIVO CON VALOR PREDETERMINADO PORQUE SERIA UNA VULNEABILIDAD CON RESPECTO AL CONTENIDO DEL DIRECOTORIO LOCAL -- >
                                    
    <!-- Los parametros que requiere la ruta los paso por el action del formulario -->

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
        @foreach ($cliente as $cli)
            <form action="{{ route('cliente.update', Session::get('user')) }}" method="POST" enctype="multipart/form-data"
                id="editarCliente">
                @csrf
                @method('PUT')
                <!--El formulario mas correcto para actualizar es mediante el metodo put-->
                <div class="form__info">
                    <label for="email" class="form__info__label">Email:</label>
                    <input type="email" class="form__controls" value="{{ $cli->email }}" name="email"
                        id="correoCliente">
                    <div id="malCorreoLoggin" class="invalid-feedback"></div>

                </div>
                <div class="form__info">
                    <label for="Nombre" class="form__info__label">Nombre:</label>
                    <input type="text" class="form__controls" placeholder="Nuevo Nombre" value="{{ $cli->nombre }}"
                        name="nombre" id="nombreCliente">
                    <div id="malNombreCliente" class="invalid-feedback"></div>

                </div>
                <div class="form__info">
                    <label for="telefono" class="form__info__label">Telefono:</label>
                    <input type="text" class="form__controls" placeholder="XXXXXXXXX" value="{{ $cli->telefono }}"
                        name="telefono" id="telefonoCliente">
                    <div id="malTelefonoCliente" class="invalid-feedback"></div>
                </div>

                <div class="form__info half">
                    <input id="botonEditarCliente" class="form__info__button" type="submit" value="Actualizar Perfil" />
                </div>
                <div class="form__info half">
                    <a class="form__info__button other" href="{{ route('inicio.inicio') }}">pagina principal</a>

                </div>
            </form>
        @endforeach
    </div>
    <script src="{{ asset('/JS/EditarCliente.js') }}"></script>
@endsection
