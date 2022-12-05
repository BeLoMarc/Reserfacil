<!-- TODO EL HTML QUE TENGA EN EL ARCHIVO PLANTILLA APARECERÁ AQUI -->
@extends('plantilla/plantilla')



@section('formulario')
    <div class="row">
        <div class="col-sm-12">
            @if ($mensa = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $mensa }}
                </div>
            @endif
            @if ($mensa = Session::get('fail'))
                <div class="alert alert-warning" role="alert">
                    {{ $mensa }}
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
                        @forelse ($restauranteUnico as $restaurante)
                            <option value="{{ $restaurante->nombre }}">{{ $restaurante->nombre }}</option>
                        @empty
                        @endforelse

                    </select>
                </div>
                <!-- CARGAR TODAS LAS LOCALIDADES -->

                <div class="form__info">
                    <label for="Select" class="form__info__label">Localidad donde quiere comer:</label>
                    <select name="localidadSelect" id="Select" class="form__controls">
                        <option value="v">Cualquier localidad</option>
                        @forelse ($localidades as $localidad)
                            <option value="{{ $localidad->codigoLocalidad }}">{{ $localidad->nombre }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>

                <!-- CARGAR TODAS LAS CATEGORIAS -->
                <div class="form__info">
                    <label for="Select" class="form__info__label">Tipo de comida del restaurante:</label>
                    <select name="categoriaSelect" id="Select" class="form__controls">
                        <option value="v">Cualquier categoria</option>
                        @forelse ($categorias as $categoria)
                            <option value="{{ $categoria->codigoCategoria }}">{{ $categoria->nombre }}</option>
                        @empty
                        @endforelse
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
    @forelse ($restaurantes as $restaurante)
        <div class="main__book">
            @if (Session::get('admin') === 0)
                <a class="main__book__link"
                    href="{{ route('restaurante.mostarInfoRestaurante', $restaurante->codigoRestaurante) }}"></a>
            @endif
            <figure class="main__book__cover">
                <img alt="" src="../Multimedia/fotosRestaurante/{{ $restaurante->foto }}" />
            </figure>
            <div class="main__book__description">
                <div class="main__book__description__title">
                    <div class="main__book__description__title__box">
                        <span class="main__book__description__title__box__name lang">{{ $restaurante->nombre }}</span>
                        <div class="main__book__description__title__box__underline"></div>
                    </div>
                </div>
                <div class="main__book__description__tags">
                    @forelse ($categoriasRestaurante as $cr)
                        @if ($cr->codigoRes == $restaurante->codigoRestaurante)
                            @forelse ($categorias as $cat)
                                @if ($cr->codigoCat == $cat->codigoCategoria)
                                    <a class="main__book__description__tags__link lang"
                                        href="">{{ $cat->nombre }}</a>
                                @endif
                            @empty
                            @endforelse
                        @endif
                    @empty
                    @endforelse
                    @forelse ($localidadesRestaurante as $lc)
                        @if ($lc->codigoRes == $restaurante->codigoRestaurante)
                            @forelse ($localidades as $loc)
                                @if ($lc->codigoLoc == $loc->codigoLocalidad)
                                    <a class="main__book__description__tags__link sketchy"
                                        href="">{{ $loc->nombre }}</a>
                                @endif
                            @empty
                            @endforelse
                        @endif
                    @empty
                    @endforelse
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
    @empty
    @endforelse
@endsection
