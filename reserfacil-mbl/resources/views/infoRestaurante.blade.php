<!-- TODO EL HTML QUE TENGA EN EL ARCHIVO PLANTILLA APARECERÁ AQUI -->
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
    <div class="row">
        <div class="col-sm-12">
            @if ($mensaje = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $mensaje }}
                </div>
            @endif
        </div>
    </div>
    <div class="form">
        <p class="form__title">Eliga Restaurante</p>
        <form action="{{ route('inicio.filtrado') }}" method="POST">
            @csrf
            <fieldset>
                <legend>Elija su restaurante perfecto</legend>
                <div class="form__info">
                    <label for="Select" class="form__info__label">Restaurante donde quieres comer:</label>
                    <select name="restauranteSelect" id="Select" class="form__controls">
                        <!-- Restaurante unico es un array de restaurantes donde estan ordenador por nombre y este no se repite -->
                        <option value="v">Cualquier Restaurante</option>
                        @foreach ($restauranteUnico as $restaurante)
                            <option value="{{ $restaurante->nombre }}">{{ $restaurante->nombre }}</option>
                        @endforeach

                    </select>
                </div>
                <!-- CARGAR TODAS LAS LOCALIDADES -->

                <div class="form__info">
                    <label for="Select" class="form__info__label">Localidad donde quiere comer:</label>
                    <select name="localidadSelect" id="Select" class="form__controls">
                        <option value="v">Cualquier localidad</option>
                        @foreach ($localidades as $localidad)
                            <option value="{{ $localidad->codigoLocalidad }}">{{ $localidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- CARGAR TODAS LAS CATEGORIAS -->
                <div class="form__info">
                    <label for="Select" class="form__info__label">Tipo de comida del restaurante:</label>
                    <select name="categoriaSelect" id="Select" class="form__controls">
                        <option value="v">Cualquier categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->codigoCategoria }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form__info half">
                    <input class="form__info__button" type="submit" value="Buscar" />
                </div>

            </fieldset>
        </form>
    </div>
@endsection
@section('restaurantes')
    <!-- Cortesia de Boostrap -->
    @foreach ($restauranteElegido as $restaurante)
        <!-- Banner del Restaurante -->
        <div class="new__title">
            <figure class="new__title__cover">
                <img alt="" src="../Multimedia/bannerRestaurante/{{ $restaurante->banner }}" />
            </figure>
        </div>

        <div class="new__manager">
            <button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample"
                aria-expanded="false" aria-controls="collapseWidthExample">

                <p class="form__title">Reservar</p>
            </button>
            <span class="new__manager__resume">
                {{ $restaurante->descripcion }}
            </span>


        </div>

        <div class="collapse collapse" id="collapseWidthExample">
            <div class="form">
                <!-- FORMULARIO PARA RESERVAR -->
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
                <form action="{{ route('reserva.store', $restaurante->codigoRestaurante) }}" method="POST"
                    enctype="multipart/form-data" id="crearReserva">
                    @csrf
                    <input type="hidden" value="{{ $restaurante->nombre }}" name="nombreR">
                    <div class="form__info">
                        <label class="form__info__label" for="fecha">Fecha:</label>
                        <input class="form__controls" type="date" name="fecha" id="fechaReserva" />
                        <div id="malFechaReserva" class="invalid-feedback"></div>
                    </div>


                    <div class="form__info">
                        <label class="form__info__label" for="hora">Hora:</label>
                        <input class="form__controls" type="time" name="hora" id="horaReserva" />
                        <div id="malHoraReserva" class="invalid-feedback"></div>
                    </div>
                    <div class="form__info">
                        <label class="form__info__label" for="hora">Personas:</label>
                        <input class="form__controls" type="number" name="personas" id="personasReserva"
                            placeholder="Numero de Personas" />
                        <div id="malPersonasReserva" class="invalid-feedback"></div>
                    </div>
                    <div class="form__info half">
                        <input class="form__info__button" type="submit" value="Guardar Reserva" id="botonCrearReserva" />
                    </div>
                    <div class="form__info half">
                        <a class="form__info__button other" href="{{ route('inicio.inicio') }}">Pagina Principal</a>
                    </div>


                    <!--      nos manda a la pantalla principal   -->

                </form>
            </div>
        </div>
        <div class="new__content">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../Multimedia/fotosRestaurante/{{ $restaurante->foto }}" class="d-block w-100"
                            alt="primera foto del restuarante">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Primera foto del restaurante</h5>

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../Multimedia/fotosRestaurante/{{ $restaurante->foto }}" class="d-block w-100"
                            alt="segunda foto del restuarante">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Segunda Foto del Restaurante</h5>

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../Multimedia/cartasRestaurante/{{ $restaurante->carta }}" class="d-block w-100"
                            alt="foto de la carta">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>carta del Restaurante</h5>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
    @endforeach




    @foreach ($restaurantes as $restaurante)
        <div class="main__book">
            <a class="main__book__link"
                href="{{ route('restaurante.mostarInfoRestaurante', $restaurante->codigoRestaurante) }}"></a>
            <figure class="main__book__cover">
                <img alt="" src="../Multimedia/fotosRestaurante/{{ $restaurante->foto }}" />
            </figure>
            <div class="main__book__description">
                <div class="main__book__description__title">
                    <div class="main__book__description__title__box">
                        <span class="main__book__description__title__box__name lang"
                            key="Curse">{{ $restaurante->nombre }}</span>
                        <div class="main__book__description__title__box__underline"></div>
                    </div>
                </div>
                <div class="main__book__description__tags">
                    @foreach ($categoriasRestaurante as $cr)
                        @if ($cr->codigoRes == $restaurante->codigoRestaurante)
                            @foreach ($categorias as $cat)
                                @if ($cr->codigoCat == $cat->codigoCategoria)
                                    <a class="main__book__description__tags__link lang"
                                        href="">{{ $cat->nombre }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @foreach ($localidadesRestaurante as $lc)
                        @if ($lc->codigoRes == $restaurante->codigoRestaurante)
                            @foreach ($localidades as $loc)
                                @if ($lc->codigoLoc == $loc->codigoLocalidad)
                                    <a class="main__book__description__tags__link sketchy"
                                        href="">{{ $loc->nombre }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                </div>
                <div class="main__book__description__author">
                    <p class="main__book__description__author__label lang" key="Autor">Telefono:</p>
                    <span class="main__book__description__author__name">{{ $restaurante->telefono }}</span>

                </div>
                <div class="main__book__description__synopsis">
                    <p class="main__book__description__synopsis__label  lang" key="Sinopsis">Direccion:</p>
                    <span class="main__book__description__synopsis__text lang"
                        key="SinCur">{{ $restaurante->direccion }}</span>
                </div>
            </div>
        </div>
    @endforeach
    <script src="{{ asset('/JS/ValidarCrearReserva.js') }}"></script>
@endsection
