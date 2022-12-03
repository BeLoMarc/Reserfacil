@extends('plantilla/plantilla')
@section('formulario')
    <!-- NO SE PUEDE PONER UN ARCHIVO CON VALOR PREDETERMINADO PORQUE SERIA UNA VULNEABILIDAD CON RESPECTO AL CONTENIDO DEL DIRECOTORIO LOCAL -- >
                                    <!-- es la url donde llamo al update de restaurantes paraa actualizar-->
    <div class="row">
        <div class="col-sm-12">
            @if ($mensaje = Session::get('fail'))
                <div class="alert alert-warning" role="alert">
                    {{ $mensaje }}
                </div>
            @endif
        </div>
    </div>
    @foreach ($reservas as $reserva)
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
            <!-- si la ruta pide un parametro debemos pasarlo en el action -->
            <form action="{{ route('reserva.update', [$reserva->codigoRes, $reserva->fecha, $reserva->hora]) }}"
                method="POST"enctype="multipart/form-data" id="editarReserva">
                @csrf
                @method('PUT')
                <!--El formulario mas correcto para actualizar es mediante el metodo put-->

                <div class="form__info">
                    <label for="fecha" class="form__info__label">Fecha:</label>
                    <input type="date" class="form__controls" value="{{ $reserva->fecha }}" name="fecha"
                        id="fechaReserva">
                    <div id="malFechaReserva" class="invalid-feedback"></div>

                </div>
                <div class="form__info">
                    <label for="hora" class="form__info__label">Hora:</label>
                    <input type="time" class="form__controls" value="{{ $reserva->hora }}" name="hora"
                        id="horaReserva">
                    <div id="malHoraReserva" class="invalid-feedback"></div>

                </div>
                <div class="form__info">
                    <label for="personas" class="form__info__label">Personas:</label>
                    <input type="number" class="form__controls" placeholder="Numero de Personas"
                        value="{{ $reserva->personas }}" name="personas" id="personasReserva">
                    <div id="malPersonasReserva" class="invalid-feedback"></div>

                </div>
                <!--      nos manda a la pantalla principal   -->
                <div class="form__info half">
                    <input id="botonEditarReserva" class="form__info__button" type="submit" value="Actualizar" />
                </div>
                <div class="form__info half">
                    <a class="form__info__button other" href="{{ route('reserva.index') }}">Mostrar Reservas</a>
                </div>
            </form>
        </div>
    @endforeach
    <script src="{{ asset('/JS/ValidarEditarReserva.js') }}"></script>
@endsection
