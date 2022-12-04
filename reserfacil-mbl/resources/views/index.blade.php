<!-- TODO EL HTML QUE TENGA EN EL ARCHIVO PLANTILLA APARECERÁ AQUI -->
@extends('plantilla/plantilla')



@section('formulario')
    <div class="row">
        <div class="col-sm-12">
            @if ($mensaje = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $mensaje }}
                </div>
            @endif
            @if ($mensaje = Session::get('fail'))
                <div class="alert alert-warning" role="alert">
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
                    <select name="restauranteSelect" id="Select" class="form__controls" >
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
    @foreach ($restaurantes as $restaurante)
        <div class="main__book">
           @if (Session::get('admin')===0)
           <a class="main__book__link"
           href="{{ route('restaurante.mostarInfoRestaurante', $restaurante->codigoRestaurante) }}"></a>   
           @endif
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
                                <a class="main__book__description__tags__link sketchy" href="">{{ $loc->nombre }}</a>
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
@endsection
