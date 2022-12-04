<!-- TODO EL HTML QUE TENGA EN EL ARCHIVO PLANTILLA APARECERÁ AQUI -->
@extends('plantilla/plantillaGerente')


{{--  
    <div class="col-sm-12">
        @auth
            <h1>{{ Auth::user()->nombre }}</h1>
            {{ Auth::user()->getRoleNames() }}
        @endauth
    </div> 
</div>   --}}
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
@endsection
@section('restaurantes')
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
