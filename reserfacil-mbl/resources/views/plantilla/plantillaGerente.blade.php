<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <!-- EL CSS TIENE QUE ESTAR EN LA CARPETA PUBLIC -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--Validacion restaurantes-->

    <title>Reserfacil</title>
</head>



<body>
    <header class="header">
        <!--
      <a href="index.html">
        <img src="../Multimedia/logo_transparent.png" alt="Logo" class="header__logo" />
      </a>
   -->



    </header>


    <nav class="nav">

        <!--no se porque se ven los botones azules del navar, el hover se ha cambiado con
          el link de bootsrap-->
        <div class="nav__index">
            <a href="{{ '/' }}">
                <img class="nav__index__img" src="../Multimedia/logo1.png" alt="logo" />
            </a>
        </div>

        <div class="nav__category">
            <a href="{{ route('cliente.logginRegistroCliente') }}" class="nav__category__link">
                <span class="nav__category__link__span lang" key="QuienesSomos"> Iniciar Sesion
                </span></a>
        </div>
        <div class="nav__category">
            <a href="{{ route('cliente.logOut') }}" class="nav__category__link"><span
                    class="nav__category__link__span lang" key="Clases">
                    Cerrar Sesion</span></a>
        </div>
        <div class="nav__category">
            <a href="{{ route('cliente.create') }}" class="nav__category__link"><span
                    class="nav__category__link__span lang" key="Clases">
                    Registrar Cliente</span></a>
        </div>
        <div class="nav__category">
            <a href="{{ route('cliente.edit') }}" class="nav__category__link"><span
                    class="nav__category__link__span lang" key="Clases">
                    Editar Perfil</span></a>
        </div>
        <div class="nav__category">
            <a href="{{ route('reserva.index') }}" class="nav__category__link">
                <span class="nav__category__link__span">
                    Mostrar Reservas </span>
            </a>
        </div>
        {{-- <div class="nav__category">
            <a class="nav__category__link">
                <span class="nav__category__link__span">
                    Iniciar sesion gerente (F)</span>
            </a>
        </div>
--}}
        <div class="nav__category">
            <a href="{{ route('restaurante.create') }}" class="nav__category__link">
                <span class="nav__category__link__span">
                    Crear Restaurante</span>
            </a>
        </div>

        <div class="nav__category">
            <a href="{{ route('restaurante.index') }}" class="nav__category__link">
                <span class="nav__category__link__span">
                    Mostrar Restaurantes</span>
            </a>
        </div>
    </nav>

    {{-- <div class=buscador>
        <form>
            <fieldset>
                <legend>Elija su restaurante perfecto</legend>
                <div class="mb-3">
                    <label for="TextInput" class="form-label">Nombre del restaurante:</label>
                    <input type="text" id="TextInput" class="form-control" placeholder="input">
                </div>
                <!-- CARGAR TODAS LAS LOCALIDADES -->
                <div class="mb-3">
                    <label for="Select" class="form-label">Localidad donde quiere comer:</label>
                    <select id="Select" class="form-select">
                        <option>select</option>
                    </select>
                </div>
                <!-- CARGAR TODAS LAS CATEGORIAS -->
                <div class="mb-3">
                    <label for="Select" class="form-label">Tipo de comida del restaurante:</label>
                    <select id="Select" class="form-select">
                        <option>select</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>
   --}}
    <main class="main" id="main">
        @yield('formulario')

        @yield('restaurantes')
        <!--
        <div class="main__book">
          <a class="main__book__link" href="https://www.amazon.es/Curse-Strahd-Dungeons-Sourcebook-Supplement/dp/0786965983"></a>
          <figure class="main__book__cover">
            <img alt="" src="../Multimedia/curseOfStrahd.jpg" />
          </figure>
          <div class="main__book__description">
            <div class="main__book__description__title">
              <div class="main__book__description__title__box">
                <span class="main__book__description__title__box__name lang" key="Curse">Maldición De Stradh</span>
                <div class="main__book__description__title__box__underline"></div>
              </div>
            </div>
            <div class="main__book__description__tags">
              <a class="main__book__description__tags__link sketchy" href="">DM</a>
              <a class="main__book__description__tags__link lang" key="Misterio" href="">Misterio</a>
              <a class="main__book__description__tags__link lang" key="Pago" href="">Pago</a>
              <a class="main__book__description__tags__link lang" key="Modulo" href="">Modulo</a>
    
    
            </div>
            <div class="main__book__description__author">
              <p class="main__book__description__author__label lang" key="Autor">Autor:</p>
              <span class="main__book__description__author__name">Wizards of the Coast</span>
    
            </div>
            <div class="main__book__description__synopsis">
              <p class="main__book__description__synopsis__label  lang" key="Sinopsis">Sinopsis:</p>
              <span class="main__book__description__synopsis__text lang" key="SinCur">Unidos por el destino, cubierta por
                furiosas nubes de
                tormenta
                y recortada contra los viejos muros del castillo ravenloft...</span>
            </div>
          </div>
        </div>
        <div class="main__book">
          <a class="main__book__link" href="Multimedia/phbCaratula.jpg"></a>
          <figure class="main__book__cover">
            <img alt="" src="../Multimedia/phbCaratula.jpg" />
          </figure>
          <div class="main__book__description">
            <div class="main__book__description__title">
              <div class="main__book__description__title__box">
                <span class="main__book__description__title__box__name lang" key="PB">Manual Del Jugador</span>
                <div class="main__book__description__title__box__underline"></div>
              </div>
            </div>
            <div class="main__book__description__tags">
              <a class="main__book__description__tags__link finish lang" key="Jugador" href="#">Jugador</a>
              <a class="main__book__description__tags__link lang" key="Complemento" href="#">Complemento</a>
              <a class="main__book__description__tags__link lang" key="Herramientas" href="#">Herramientas</a>
              <a class="main__book__description__tags__link lang" key="desarrollo" href="#">desarrollo</a>
    
            </div>
            <div class="main__book__description__author">
              <p class="main__book__description__author__label lang" key="Autor">Autor:</p>
              <span class="main__book__description__author__name">Wizard of the Coast</span>
            </div>
            <div class="main__book__description__synopsis">
              <p class="main__book__description__synopsis__label lang" key="Sinopsis">Sinopsis:</p>
              <span class="main__book__description__synopsis__text lang" key="PBSin">El Manual del jugador es el libro de
                referencia esencial
                para todos los jugadores de Dungeons & Dragons....</span>
            </div>
          </div>
        </div>
        -->

    </main>



    <aside class="aside">
        <div class="aside__event">
            <figure class="aside__event__figure">
                <a href="noticia.html">
                    <img src="../Multimedia/analysis-1841158_640.jpg" />
                </a>
            </figure>
            <div class="aside__event__description">
                <time class="aside__event__description__time">RANKING</time>
                <span class="aside__event__description__text lang"> Tu restaurante esta situado el numero 7 de los mas
                    reservados</span>
            </div>
        </div>


        <div class="aside__event">
            <figure class="aside__event__figure">
                <a href="#">
                    <img src="../Multimedia/balloon-1014411_640.jpg" />
                </a>
            </figure>
            <div class="aside__event__description">
                <time class="aside__event__description__time">OPINIONES</time>
                <span class="aside__event__description__text  lang">Las opiniones positivas de los clientes han
                    aumentado un 13%</span>
            </div>
        </div>
        <div class="aside__event">
            <figure class="aside__event__figure">
                <a href="">
                    <img src="../Multimedia/fire-8837_640.jpg" alt="" />
                </a>
            </figure>
            <div class="aside__event__description">
                <time class="aside__event__description__time">MENU</time>
                <span class="aside__event__description__text  lang">El menu más solicitado es el numero 3</span>

            </div>
        </div>


    </aside>
    <footer class="footer">
        <div class="footer__direction">
            <section itemscope itemtype="https://schema.org/Organization">
                <p itemprop="name">Reserfacil</p>
                <section itemscope itemtype="https://schema.org/PostalAddress">

                    <span itemprop="streetAddress">Direccion Empresa</span>
                    <span itemprop="postalCode">347290</span>
                    <span itemprop="addressLocality">Ciudad Real, España</span>
                </section>
                <p>Tel: <span itemprop="telephone">(33 1) 42 68 53 00</span></p>
                <p>E-mail: <span itemprop="email">MarcosBenitoLopez@Maestre.com</span></p>
            </section>
        </div>
        <div class="footer__cc">

            <section itemscope itemtype="https://schema.org/Person">
                <dl>
                    <dt>Proyecto</dt>
                    <dd itemprop="name">Marcos Benito López</dd>
                    <meta itemprop="address" content="Calle Toledo, 234" />
                </dl>
            </section>
        </div>
        <div class="footer__social">
            <figure class="footer__social__figure">
                <a href="https://www.facebook.com">
                    <img src="../Multimedia/facebook.png" />
                </a>
            </figure>
            <figure class="footer__social__figure">
                <a href="https://www.instagram.com">

                    <img src="../Multimedia/instagram.png" />
                </a>
            </figure>
            <figure class="footer__social__figure">
                <a href="https://twitter.com">
                    <img src="../Multimedia/twitter.png" />
                </a>
            </figure>


        </div>
    </footer>
</body>



</html>
