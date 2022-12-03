'use Strict'
let fotoCartaCorrecto;
let bannerRestauranteCorrecto;
let fotoRestauranteCorrecto;
let nombreRestauranteCorrecto;
let direccionRestauranteCorrecto;
let descripcionRestauranteCorrecto;
let telefonoRestauranteCorrecto;
let checkCategoriasCorrecto;
let checkLocalidadesCorrecto;

$('#main').on('click', '#botonCrearRestaurante', function (event) {
    console.log("Dentro del metodo de reataurante")
    event.preventDefault();
    validarcrearRestaurante();
    if (correctoCrearRestaurante()) {
        $("#crearRestaurante").submit();
    }
});


function validarcrearRestaurante() {
    //ASi recojo los valores de los inputs
    let inputFotoCarta = $('#fotoCarta'); //
    let inputFotoRestaurante = $('#fotoRestaurante'); //
    inputBannerRestaurante = $('#bannerRestaurante');
    let inputNombreRestaurante = $('#nombreRestaurante'); //
    let inputDireccionRestaurante = $('#direccionRestaurante'); //
    let inputDescripcionRestaurante = $('#descripcionRestaurante'); //
    let inputTelefonoRestaurante = $('#telefonoRestaurante'); //
    let checkCategorias = $('[name="cats[]"]:checked').length; // recoge la cantidad de checkboxes marcados
    let checkLocalidades = $('[name="locs[]"]:checked').length; // 

    /**
     * INICIO VALIDACION FOTO CARTA
     */
    if (!inputFotoCarta.val()) {
        inputFotoCarta.addClass("is-invalid");
        inputFotoCarta.removeClass("is-valid");
        $('#malCartaRestaurante').empty();
        $('#malCartaRestaurante').append(`La carta del restaurante no puede estar vacia`);
    } else if (!(/.(jpe?g|tiff?|png|webp|bmp)$/i.test(inputFotoCarta.val()))) {
        inputFotoCarta.addClass("is-invalid");
        inputFotoCarta.removeClass("is-valid");
        $('#malCartaRestaurante').empty();
        $('#malCartaRestaurante').append(`El archivo no cumple con debe ser .jpg, .jpeg, .tiff, .png, .webp, .bmp`);

    } else if (inputFotoCarta[0].files[0].size > 2000000) {
        inputFotoCarta.addClass("is-invalid");
        inputFotoCarta.removeClass("is-valid");
        $('#malCartaRestaurante').empty();
        $('#malCartaRestaurante').append(`El archivo debe pesar menos de 2MB`);
    }
    else {
        inputFotoCarta.addClass("is-valid");
        inputFotoCarta.removeClass("is-invalid");
        //$('#buenFotoTienda').empty();
        //$('#buenFotoTienda').append(`La foto ta bien`);
        // inputFotoTienda.closest(".valid-feedback").html("LA LONGITUD de la tienda esta correcto")
        fotoCartaCorrecto = true;
    }
    /**
        * INICIO VALIDACION FOTO BANNER
        */
    if (!inputBannerRestaurante.val()) {

        inputBannerRestaurante.addClass("is-invalid");
        inputBannerRestaurante.removeClass("is-valid");
        $('#malBannerRestaurante').empty();
        $('#malBannerRestaurante').append(`La carta del restaurante no puede estar vacia`);


    } else if (!(/.(gif|jpe?g|tiff?|png|webp|bmp)$/i.test(inputBannerRestaurante.val()))) {
        inputBannerRestaurante.addClass("is-invalid");
        inputBannerRestaurante.removeClass("is-valid");
        $('#malBannerRestaurante').empty();
        $('#malBannerRestaurante').append(`El archivo no cumple con debe ser .gif, .jpg, .jpeg, .tiff, .png, .webp, .bmp`);

    } else if (inputBannerRestaurante[0].files[0].size > 2000000) {
        inputBannerRestaurante.addClass("is-invalid");
        inputBannerRestaurante.removeClass("is-valid");
        $('#malBannerRestaurante').empty();
        $('#malBannerRestaurante').append(`El archivo debe pesar menos de 2MB`);
    }
    else {
        inputBannerRestaurante.addClass("is-valid");
        inputBannerRestaurante.removeClass("is-invalid");
        //$('#buenFotoTienda').empty();
        //$('#buenFotoTienda').append(`La foto ta bien`);
        // inputFotoTienda.closest(".valid-feedback").html("LA LONGITUD de la tienda esta correcto")
        bannerRestauranteCorrecto = true;
    }
    /**
     * INICIO VALIDACION FOTO RESTAURANTE
     */
    if (!inputFotoRestaurante.val()) {

        inputFotoRestaurante.addClass("is-invalid");
        inputFotoRestaurante.removeClass("is-valid");
        $('#malFotoRestaurante').empty();
        $('#malFotoRestaurante').append(`La foto del restaurante no puede estar vacia`);

    } else if (!(/.(jpe?g|tiff?|png|webp|bmp)$/i.test(inputFotoRestaurante.val()))) {
        inputFotoRestaurante.addClass("is-invalid");
        inputFotoRestaurante.removeClass("is-valid");
        $('#malFotoRestaurante').empty();
        $('#malFotoRestaurante').append(`El archivo no cumple con debe ser .jpg, .jpeg, .tiff, .png, .webp, .bmp`);

    } else if (inputFotoRestaurante[0].files[0].size > 2000000) {
        inputFotoRestaurante.addClass("is-invalid");
        inputFotoRestaurante.removeClass("is-valid");
        $('#malFotoRestaurante').empty();
        $('#malFotoRestaurante').append(`El archivo debe pesar menos de 2MB`);
    }
    else {
        inputFotoRestaurante.addClass("is-valid");
        inputFotoRestaurante.removeClass("is-invalid");
        //$('#buenFotoTienda').empty();
        //$('#buenFotoTienda').append(`La foto ta bien`);
        // inputFotoTienda.closest(".valid-feedback").html("LA LONGITUD de la tienda esta correcto")
        fotoRestauranteCorrecto = true;
    }

    /**
     * INICIO VALIDACION NOMBRE RESTAURANTE
     */
    if (!inputNombreRestaurante.val()) {
        inputNombreRestaurante.addClass("is-invalid");
        inputNombreRestaurante.removeClass("is-valid");
        $('#malNombreRestaurante').empty();
        $('#malNombreRestaurante').append(`No puede estar Vacio el Nombre del restaurante`);

        // inputnombreTienda.closest(".invalid-feedback").html("No puede estar Vacio el Nombre de la tienda")

    } else if (inputNombreRestaurante.val().length > 200) {
        inputNombreRestaurante.addClass("is-invalid");
        inputNombreRestaurante.removeClass("is-valid");
        $('#malNombreRestaurante').empty();
        $('#malNombreRestaurante').append(`No puedes superar los 200 caracteres`);

    }
    else {
        inputNombreRestaurante.addClass("is-valid");
        inputNombreRestaurante.removeClass("is-invalid");
        // $('#buenNombreTienda').empty();
        // $('#buenNombreTienda').append(`El nombre de la tienda esta correcto`);
        nombreRestauranteCorrecto = true;
    }

    /**
     * INICIO VALIDACION DIRECCION RESTAURANTE
     */
    if (!inputDireccionRestaurante.val()) {
        inputDireccionRestaurante.addClass("is-invalid");
        inputDireccionRestaurante.removeClass("is-valid");
        $('#malDireccionRestaurante').empty();
        $('#malDireccionRestaurante').append(`No puede estar vacia la direccion del restaurante`);


    }
    else if (inputDireccionRestaurante.val().length > 200) {
        inputDireccionRestaurante.addClass("is-invalid");
        inputDireccionRestaurante.removeClass("is-valid");
        $('#malDireccionRestaurante').empty();
        $('#malDireccionRestaurante').append(`No puedes superar los 200 caracteres`);
    }
    else {
        inputDireccionRestaurante.addClass("is-valid");
        inputDireccionRestaurante.removeClass("is-invalid");
        // $('#buenNombreTienda').empty();
        // $('#buenNombreTienda').append(`El nombre de la tienda esta correcto`);
        direccionRestauranteCorrecto = true;
    }

    /**
     * INICIO VALIDACION DESCRIPCION RESTAURANTE
     */
    if (!inputDescripcionRestaurante.val()) {
        inputDescripcionRestaurante.addClass("is-invalid");
        inputDescripcionRestaurante.removeClass("is-valid");
        $('#malDescripcionRestaurante').empty();
        $('#malDescripcionRestaurante').append(`No puede estar vacia la descripcion del restaurante`);


    } else if (inputDescripcionRestaurante.val().length > 100) {
        inputDescripcionRestaurante.addClass("is-invalid");
        inputDescripcionRestaurante.removeClass("is-valid");
        $('#malDescripcionRestaurante').empty();
        $('#malDescripcionRestaurante').append(`No puede tener mas de 100 caracteres`);
    } else {
        inputDescripcionRestaurante.addClass("is-valid");
        inputDescripcionRestaurante.removeClass("is-invalid");
        // $('#buenNombreTienda').empty();
        // $('#buenNombreTienda').append(`El nombre de la tienda esta correcto`);
        descripcionRestauranteCorrecto = true;
    }

    /**
     * INICIO VALIDACION TELEFONO RESTAURANTE
     */
    if (!inputTelefonoRestaurante.val()) {
        inputTelefonoRestaurante.addClass("is-invalid");
        inputTelefonoRestaurante.removeClass("is-valid");
        $('#malTelefonoRestaurante').empty();
        $('#malTelefonoRestaurante').append(`El telefono no puede estar vacio`);
        //inputtelefonoTienda.closest(".invalid-feedback").html("No puede estar Vacio el Nombre de la tienda")

    } else if (!(/[0-9]{3}[0-9]{3}[0-9]{3}/g.test(inputTelefonoRestaurante.val())) || (Number.parseInt(
        inputTelefonoRestaurante.val().length) > 11)) {
        inputTelefonoRestaurante.addClass("is-invalid");
        inputTelefonoRestaurante.removeClass("is-valid");
        $('#malTelefonoRestaurante').empty();
        $('#malTelefonoRestaurante').append(`El telefono debe tener 9 numeros siguiendo el patron XXXXXXXXX`);
        //inputtelefonoTienda.closest(".invalid-feedback").html("el telefono debe tener 9 numeros siguiendo el patron XXX-XXX-XXX")
    } else {
        inputTelefonoRestaurante.addClass("is-valid");
        inputTelefonoRestaurante.removeClass("is-invalid");
        //$('#buenTelefonoRestaurante').empty();
        //      $('#buenTelefonoRestaurante').append(`El telefono de la tienda esta correcto`);
        //inputtelefonoTienda.closest(".valid-feedback").html("El telefono de la tienda esta correcto")
        telefonoRestauranteCorrecto = true;
    }

    /**
     * INICIO VALIDACION CHEKS CATEGORIAS
     */
    if (checkCategorias == 0) {

        $('[name="cats[]"]').addClass("is-invalid");
        $('[name="cats[]"]').removeClass("is-valid");
        $('#malCheckCategorias').empty();
        $('#malCheckCategorias').append(`Debes elegir al menos una categoria`);

        //inputCIFTienda.closest(".invalid-feedback").html("No puede estar Vacio la descripcion")
    } else {
        $('[name="cats[]"]').addClass("is-valid");
        $('[name="cats[]"]').removeClass("is-invalid");
        $('#buenCheckCategorias').empty();
        //$('#buenCifTienda').append(`La categoria cumple los requisitos`);
        checkCategoriasCorrecto = true;
    }

    /**
     * INICIO VALIDACION CHEKS CATEGORIAS
     */
    if (checkLocalidades == 0) {

        $('[name="locs[]"]').addClass("is-invalid");
        $('[name="locs[]"]').removeClass("is-valid");
        $('#malCheckLocalidades').empty();
        $('#malCheckLocalidades').append(`Debes elegir al menos una categoria`);

        //inputCIFTienda.closest(".invalid-feedback").html("No puede estar Vacio la descripcion")
    } else {
        $('[name="locs[]"]').addClass("is-valid");
        $('[name="locs[]"]').removeClass("is-invalid");
        $('#buenCheckLocalidades').empty();
        //$('#buenCifTienda').append(`La categoria cumple los requisitos`);
        checkLocalidadesCorrecto = true;
    }

}

function correctoCrearRestaurante() {

    return fotoCartaCorrecto &&
        fotoRestauranteCorrecto &&
        nombreRestauranteCorrecto &&
        direccionRestauranteCorrecto &&
        descripcionRestauranteCorrecto &&
        telefonoRestauranteCorrecto &&
        checkCategoriasCorrecto &&
        checkLocalidadesCorrecto;

}