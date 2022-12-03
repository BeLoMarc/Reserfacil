'use Strict'
let correoCorrecto;
let contraseñaCorrecto;

$('#main').on('click', '#botonInicioSesion', function (event) {
    console.log("Dentro del metodo de reataurante")
    event.preventDefault();
    validarLoggin();
    if (correctoLoggin()) {
        $("#Loggin").submit();
    }
});


function validarLoggin() {
    //ASi recojo los valores de los inputs
    let inputCorreoLoggin = $('#correoLoggin'); //
    let inputContraseniaLoggin = $('#contraseniaLoggin'); //



    /**
     * INICIO VALIDACION FECHA RESERVA
     */
    if (!inputCorreoLoggin.val()) {

        inputCorreoLoggin.addClass("is-invalid");
        inputCorreoLoggin.removeClass("is-valid");
        $('#malCorreoLoggin').empty();
        $('#malCorreoLoggin').append(`El email no puede estar vacio`);
    } else if (!(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(inputCorreoLoggin.val()))) {
        inputCorreoLoggin.addClass("is-invalid");
        inputCorreoLoggin.removeClass("is-valid");
        $('#malCorreoLoggin').empty();
        $('#malCorreoLoggin').append(`El email debe ser escrito siguiendo el patron NOMBRE+@+SERVIDOR+DOMINIO`);
    } else {
        inputCorreoLoggin.addClass("is-valid");
        inputCorreoLoggin.removeClass("is-invalid");
        correoCorrecto = true;
    }

    /**
     * INICIO VALIDACION HORA RESERVA
     */
    if (!inputContraseniaLoggin.val()) {

        inputContraseniaLoggin.addClass("is-invalid");
        inputContraseniaLoggin.removeClass("is-valid");
        $('#malContraseñaLoggin').empty();
        $('#malContraseñaLoggin').append(`La Contraseña no puede estar vacia`);

    } else {
        inputContraseniaLoggin.addClass("is-valid");
        inputContraseniaLoggin.removeClass("is-invalid");

        contraseñaCorrecto = true;
    }

    


}

function correctoLoggin() {

    return correoCorrecto &&
        contraseñaCorrecto;

}