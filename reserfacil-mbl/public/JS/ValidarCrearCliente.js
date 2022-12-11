'use Strict'
let nombreClienteCorrecto;
let correoClienteCorrecto;
let contraseniaClienteCorrecto;
let telefonoClienteCorrecto;


$('#main').on('click', '#botonCrearCliente', function (event) {

    event.preventDefault();
    validarCrearCliente();
    if (correctoCrearCliente()) {
        $("#crearCliente").submit();
    }
});


function validarCrearCliente() {
    //ASi recojo los valores de los inputs
    let inputNombreCliente = $('#nombreCliente');
    let inputCorreoCliente = $('#correoCliente');
    let inputContraseniaCliente = $('#contraseñaCliente');
    let inputTelefonoCliente = $('#telefonoCliente');


    /**
     * INICIO VALIDACION NOMBRE CLIENTE
     */
    if (!inputNombreCliente.val()) {

        inputNombreCliente.addClass("is-invalid");
        inputNombreCliente.removeClass("is-valid");
        $('#malNombreCliente').empty();
        $('#malNombreCliente').append(`El nombre no puede estar vacio`);
        nombreClienteCorrecto = false;
    } else if (inputNombreCliente.val().length > 200) {
        inputNombreCliente.addClass("is-invalid");
        inputNombreCliente.removeClass("is-valid");
        $('#malNombreCliente').empty();
        $('#malNombreCliente').append(`El nombre no puede tener mas de 200 caracteres`);
        nombreClienteCorrecto = false;

    }
    else {
        inputNombreCliente.addClass("is-valid");
        inputNombreCliente.removeClass("is-invalid");
        nombreClienteCorrecto = true;
    }

    /**
     * INICIO VALIDACION CORREO CLIENTE
     */
    if (!inputCorreoCliente.val()) {

        inputCorreoCliente.addClass("is-invalid");
        inputCorreoCliente.removeClass("is-valid");
        $('#malCorreoCliente').empty();
        $('#malCorreoCliente').append(`El email no puede estar vacio`);
        correoClienteCorrecto = false;
    } else if (!(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(inputCorreoCliente.val()))) {
        inputCorreoCliente.addClass("is-invalid");
        inputCorreoCliente.removeClass("is-valid");
        $('#malCorreoCliente').empty();
        $('#malCorreoCliente').append(`El email debe ser escrito siguiendo el patron NOMBRE+@+SERVIDOR+DOMINIO`);
        correoClienteCorrecto = false;
    } else {
        inputCorreoCliente.addClass("is-valid");
        inputCorreoCliente.removeClass("is-invalid");
        correoClienteCorrecto = true;
    }

    /**
     * INICIO VALIDACION CONTRASEÑA
     */
    if (!inputContraseniaCliente.val()) {
        inputContraseniaCliente.addClass("is-invalid");
        inputContraseniaCliente.removeClass("is-valid");
        $('#malContraseñaCliente').empty();
        $('#malContraseñaCliente').append(`La contraseña no puede estar vacia`);
        contraseniaClienteCorrecto = false;
    } else if (inputContraseniaCliente.val().length > 200) {
        inputContraseniaCliente.addClass("is-invalid");
        inputContraseniaCliente.removeClass("is-valid");
        $('#malContraseñaCliente').empty();
        $('#malContraseñaCliente').append(`La contraseña no puede tener mas de 200 caracteres`);
        contraseniaClienteCorrecto = false;

    }
    else {
        inputContraseniaCliente.addClass("is-valid");
        inputContraseniaCliente.removeClass("is-invalid");

        contraseniaClienteCorrecto = true;
    }

    /**
     * INICIO VALIDACION TELEFONO CLIENTE
     */
    if (!inputTelefonoCliente.val()) {
        inputTelefonoCliente.addClass("is-invalid");
        inputTelefonoCliente.removeClass("is-valid");
        $('#malTelefonoCliente').empty();
        $('#malTelefonoCliente').append(`el telefono no puede estar vacio`);
        telefonoClienteCorrecto = false;
    } else if (!(/[0-9]{3}[0-9]{3}[0-9]{3}/g.test(inputTelefonoCliente.val())) || (Number.parseInt(
        inputTelefonoCliente.val().length) > 9)) {
        inputTelefonoCliente.addClass("is-invalid");
        inputTelefonoCliente.removeClass("is-valid");
        $('#malTelefonoCliente').empty();
        $('#malTelefonoCliente').append(`el telefono debe tener 9 numeros siguiendo el patron XXXXXXXXX`);
        telefonoClienteCorrecto = false;

    } else {
        inputTelefonoCliente.addClass("is-valid");
        inputTelefonoCliente.removeClass("is-invalid");
        $('#buenTelefonoCliente').empty();

        telefonoClienteCorrecto = true;
    }

}

function correctoCrearCliente() {

    return nombreClienteCorrecto &&
        correoClienteCorrecto &&
        contraseniaClienteCorrecto &&
        telefonoClienteCorrecto;

}