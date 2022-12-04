@extends('plantilla/plantillaGerente')
@section('formulario')
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
        <form action="{{ route('restaurante.store') }}" method="POST" id="crearRestaurante" enctype="multipart/form-data">
            @csrf
            <!--<div class="mb-3"> SI SE PONE COMO DISABLED NO RECOGE EL VALOR PERO SI LO MUESTRA
                                                                                                                            <label for="codigoGer" class="form-label">Codigo Gerente, ELIMINAR MAS TARDE, DEBE IR SINCRONIZADO:</label>
                                                                                                                            <input type="text" class="form-control" id="" value="" name="codigoGer" >
                                                                                                                        </div>-->
            <div class="form__info">
                <label for="carta" class="form__info__label">Imagen de la Carta:</label>
                <input type="file" class="form__controls" id="fotoCarta" value="" name="carta">
                <div id="malCartaRestaurante" class="invalid-feedback"></div>
            </div>
            <div class="form__info">
                <label for="foto" class="form__info__label">Imagen del restaurante:</label>
                <input type="file" class="form__controls" value="" name="foto" id="fotoRestaurante">
                <div id="malFotoRestaurante" class="invalid-feedback"></div>
            </div>
            <div class="form__info">
                <label for="banner" class="form__info__label">Banner del restaurante:</label>
                <input type="file" class="form__controls" value="" name="banner" id="bannerRestaurante">
                <div id="malBannerRestaurante" class="invalid-feedback"></div>
            </div>
            <div class="form__info">
                <label for="Nombre" class="form__info__label">Nombre:</label>
                <input type="text" class="form__controls" placeholder="Nombre del restaurante" value=""
                    name="nombre" id="nombreRestaurante">
                <div id="malNombreRestaurante" class="invalid-feedback"></div>
            </div>
            <div class="form__info">
                <label for="direccion" class="form__info__label">Direccion:</label>
                <input type="text" class="form__controls" placeholder="Direccion del restaurante" value=""
                    name="direccion" id="direccionRestaurante">
                <div id="malDireccionRestaurante" class="invalid-feedback"></div>

            </div>
            <div class="form__info">
                <label for="descripcion" class="form__info__label">Descripcion:</label>
                <input type="text" class="form__controls" placeholder="descripcion del restaurante" value=""
                    name="descripcion" id="descripcionRestaurante">
                <div id="malDescripcionRestaurante" class="invalid-feedback"></div>

            </div>
            <div class="form__info">
                <label for="telefono" class="form__info__label">Telefono:</label>
                <input type="text" class="form__controls" placeholder="XXXXXXXXX" value="" name="telefono"
                    id="telefonoRestaurante">
                <div id="malTelefonoRestaurante" class="invalid-feedback"></div>

            </div>
            <div class="form__info">
                <label for="categorias" class="form__info__label">Categorias:</label>
                @foreach ($categorias as $categoria)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value={{ $categoria->codigoCategoria }}
                            name="cats[]">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $categoria->nombre }}
                        </label>
                    </div>
                @endforeach
                <div id="malCheckCategorias" class="invalid-feedback"></div>

            </div>
            <div class="form__info">
                <label for="localidades" class="form__info__label">Localidades:</label>
                @foreach ($localidad as $loc)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value={{ $loc->codigoLocalidad }}
                            id="flexCheckDefault" name="locs[]">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $loc->nombre }}
                        </label>
                    </div>
                @endforeach
                <div id="malCheckLocalidades" class="invalid-feedback"></div>
            </div>

            <div class="form__info half">
                <input id="botonCrearRestaurante" class="form__info__button" type="submit" value="Crear Restaurante" />
            </div>
            <div class="form__info half">
                <a class="form__info__button other" href="{{ route('restaurante.index') }}">Mostrar Restaurante</a>
            </div>
    </div>
    </div>

    </form>
    <script src="{{ asset('/JS/ValidarCrearRestaurante.js') }}"></script>
@endsection
