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
    </header>


    <nav class="nav">

        <!--no se porque se ven los botones azules del navar, el hover se ha cambiado con
          el link de bootsrap-->
        <div class="nav__index">
            <a href="{{ '/' }}">
                <img class="nav__index__img" src="../Multimedia/logo1.png" alt="logo" />
            </a>
        </div>

        @if (!Session::get('user'))
            <div class="nav__category">
                <a href="{{ route('cliente.logginRegistroCliente') }}" class="nav__category__link">
                    <span class="nav__category__link__span lang"> Iniciar Sesion
                    </span></a>
            </div>
        @endif

        @if (Session::get('admin') === 0)
            <div class="nav__category">
                <a href="{{ route('cliente.edit') }}" class="nav__category__link"><span
                        class="nav__category__link__span lang" key="Clases">
                        Editar Perfil</span></a>
            </div>
        @endif
        @if (Session::get('admin') === 0)
            <div class="nav__category">
                <a href="{{ route('reserva.index') }}" class="nav__category__link">
                    <span class="nav__category__link__span">
                        Mostrar Reservas </span>
                </a>
            </div>
        @endif
        @if (!Session::get('user'))
            <div class="nav__category">
                <a href="{{ route('cliente.create') }}" class="nav__category__link"><span
                        class="nav__category__link__span lang" key="Clases">
                        Registrar Cliente</span></a>
            </div>
        @endif

        @if (!Session::get('user'))
            <div class="nav__category">
                <a class="nav__category__link">
                    <span class="nav__category__link__span"> Para poder ver los detalles de los restaurantes no
                        olvides iniciar sesion
                    </span>
                </a>
            </div>
        @endif
        @if (Session::get('admin') === 1)
            <div class="nav__category">
                <a href="{{ route('restaurante.create') }}" class="nav__category__link">
                    <span class="nav__category__link__span">
                        Crear Restaurante</span>
                </a>
            </div>
        @endif
        @if (Session::get('admin') === 1)
            <div class="nav__category">
                <a href="{{ route('restaurante.index') }}" class="nav__category__link">
                    <span class="nav__category__link__span">
                        Mostrar Restaurantes</span>
                </a>
            </div>
        @endif
        @if (Session::get('user'))
            <div class="nav__category">
                <a href="{{ route('cliente.logOut') }}" class="nav__category__link"><span
                        class="nav__category__link__span lang">
                        Cerrar Sesion</span></a>
            </div>
        @endif

    </nav>

    <main class="main" id="main">

        @yield('formulario')

        @yield('restaurantes')


    </main>



    <aside class="aside">
        <div class="aside__event">
            <figure class="aside__event__figure">
                <a href="#">
                    <img src="../Multimedia/finger-3530353_640.jpg" />
                </a>
            </figure>
            <div class="aside__event__description">
                <time class="aside__event__description__time">RANKING</time>
                <span class="aside__event__description__text lang"> El restaurante más Visitado esta semana es
                    CociFacil</span>
            </div>
        </div>


        <div class="aside__event">
            <figure class="aside__event__figure">
                <a href="#">
                    <img src="../Multimedia/discount-5226409_640.jpg" />
                </a>
            </figure>
            <div class="aside__event__description">
                <time class="aside__event__description__time">OFERTAS</time>
                <span class="aside__event__description__text  lang" key="Faerun">No te olvides de usar nuestro
                    codigo de descuento en reservas ReserFacil00</span>
            </div>
        </div>
        <div class="aside__event">
            <figure class="aside__event__figure">
                <a href="#">
                    <img src="../Multimedia/ice-cream-2588541_640.jpg" alt="" />
                </a>
            </figure>
            <div class="aside__event__description">
                <time class="aside__event__description__time">GUSTOS</time>
                <span class="aside__event__description__text  lang">Porque te gustan estos restaurantes te
                    recomendamos...</span>

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


                <a href="https://www.instagram.com">

                    <img src="../Multimedia/instagram.png" />
                </a>

                <a href="https://twitter.com">
                    <img src="../Multimedia/twitter.png" />
                </a>
            </figure>


        </div>
    </footer>
</body>



</html>
