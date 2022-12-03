@extends('plantilla/plantillaGerente')
@section('formulario')
    <!-- NO SE PUEDE PONER UN ARCHIVO CON VALOR PREDETERMINADO PORQUE SERIA UNA VULNEABILIDAD CON RESPECTO AL CONTENIDO DEL DIRECOTORIO LOCAL -- >
                                        <!-- es la url donde llamo al update de restaurantes paraa actualizar-->
    @foreach ($restaurantes as $restaurante)
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
            <form action="{{ route('restaurante.update', $restaurante->codigoRestaurante) }}" method="POST"
                enctype="multipart/form-data" id="editarRestaurante">
                @csrf
                @method('PUT')
                <!--El formulario mas correcto para actualizar es mediante el metodo put-->


                <input hidden type="text" class="form-control" value="{{ $restaurante->codigoRestaurante }}"
                    name="codigoRestaurante">
                <div class="form__info">
                    <label for="carta" class="form__info__label">Imagen de la Carta:</label>
                    <input type="file" class="form__controls" id="fotoCarta" value="{{ $restaurante->carta }}"
                        name="carta">
                    <div id="malCartaRestaurante" class="invalid-feedback"></div>

                </div>
                <div class="form__info">
                    <label for="foto" class="form__info__label">Imagen del restaurante:</label>
                    <input type="file" class="form__controls" id="fotoRestaurante" value="{{ $restaurante->foto }}"
                        name="foto">
                    <div id="malFotoRestaurante" class="invalid-feedback"></div>

                </div>
                <div class="form__info">
                    <label for="banner" class="form__info__label">Banner del restaurante:</label>
                    <input type="file" class="form__controls" value="" name="banner" id="bannerRestaurante">
                    <div id="malBannerRestaurante" class="invalid-feedback"></div>
                </div>
                <div class="form__info">
                    <label for="Nombre" class="form__info__label">Nombre:</label>
                    <input type="text" class="form__controls" placeholder="Nombre del Restaurante"
                        value="{{ $restaurante->nombre }}" name="nombre" id="nombreRestaurante">

                    <div id="malNombreRestaurante" class="invalid-feedback"></div>
                </div>
                <div class="form__info">
                    <label for="Nombre" class="form__info__label">Descripcion:</label>
                    <input type="text" class="form__controls" placeholder="descripcion del Restaurante"
                        value="{{ $restaurante->descripcion }}" name="descripcion" id="descripcionRestaurante">
                    <div id="malDescripcionRestaurante" class="invalid-feedback"></div>

                </div>
                <div class="form__info">
                    <label for="direccion" class="form__info__label">Direccion:</label>
                    <input type="text" class="form__controls" placeholder="Direccion del nuevo restaurante"
                        value="{{ $restaurante->direccion }}" name="direccion" id="direccionRestaurante">
                    <div id="malDireccionRestaurante" class="invalid-feedback"></div>

                </div>
                <div class="form__info">
                    <label for="telefono" class="form__info__label">Telefono:</label>
                    <input type="text" class="form__controls" placeholder="XXXXXXXXX"
                        value="{{ $restaurante->telefono }}" name="telefono" id="telefonoRestaurante">
                    <div id="malTelefonoRestaurante" class="invalid-feedback"></div>

                </div>
                <div class="form__info">
                    <label for="cats" class="form__info__label">Categorias:</label>
                    @foreach ($categorias as $categoria)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value={{ $categoria->codigoCategoria }}
                                id="flexCheckDefault" name="cats[]" @if (in_array($categoria->codigoCategoria, $catCheck)) checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $categoria->nombre }}
                            </label>
                        </div>
                    @endforeach
                    <div id="malCheckCategorias" class="invalid-feedback"></div>

                </div>
                <div class="form__info">
                    <label for="locs" class="form__info__label">Localidades:</label>
                    @foreach ($localidades as $loc)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value={{ $loc->codigoLocalidad }}
                                id="flexCheckDefault" name="locs[]" @if (in_array($loc->codigoLocalidad, $locCheck)) checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $loc->nombre }}
                            </label>
                        </div>
                    @endforeach
                    <div id="buenCheckLocalidades" class="invalid-feedback"></div>

                </div>
    @endforeach

    <div class="form__info half">
        <input id="botonEditarRestaurante" class="form__info__button" type="submit" value="Actualizar restaurante" />
    </div>
    <div class="form__info half">
        <a class="form__info__button other" href="{{ route('restaurante.index') }}">Mostrar Restaurantes</a>
    </div>
    </form>
    </div>
    <script src="{{ asset('/JS/ValidarEditarRestaurante.js') }}"></script>
@endsection
