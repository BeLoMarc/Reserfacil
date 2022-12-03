'use Strict'
let fechaCorrecto;
let horaCorrecto;
let personasCorrecto;

$('#main').on('click', '#botonEditarReserva', function (event) {
    console.log("Dentro del metodo de reataurante")
    event.preventDefault();
    validarEditarReserva();
    if (correctoEditarReserva()) {
        $("#editarReserva").submit();
    }
});


function validarEditarReserva() {
    //ASi recojo los valores de los inputs
    let inputFechaReserva = $('#fechaReserva'); //
    let inputHoraReserva = $('#horaReserva'); //
    let inputPersonasReserva = $('#personasReserva'); //


    /**
     * INICIO VALIDACION FECHA RESERVA
     */
    if (!inputFechaReserva.val()) {

        inputFechaReserva.addClass("is-invalid");
        inputFechaReserva.removeClass("is-valid");
        $('#malFechaReserva').empty();
        $('#malFechaReserva').append(`Debes elegir la fecha que quieres ir al restaurante`);
    } else {
        inputFechaReserva.addClass("is-valid");
        inputFechaReserva.removeClass("is-invalid");
        fechaCorrecto = true;
    }

    /**
     * INICIO VALIDACION HORA RESERVA
     */
    if (!inputHoraReserva.val()) {

        inputHoraReserva.addClass("is-invalid");
        inputHoraReserva.removeClass("is-valid");
        $('#malHoraReserva').empty();
        $('#malHoraReserva').append(`La hora de la reserva no puede estar vacia`);

    } else {
        inputHoraReserva.addClass("is-valid");
        inputHoraReserva.removeClass("is-invalid");

        horaCorrecto = true;
    }

    /**
     * INICIO VALIDACION CANTIDAD PERSONAS
     */
    if (!inputPersonasReserva.val()) {
        inputPersonasReserva.addClass("is-invalid");
        inputPersonasReserva.removeClass("is-valid");
        $('#malPersonasReserva').empty();
        $('#malPersonasReserva').append(`No puede estar Vacio el Nombre del restaurante`);

    } else if(inputPersonasReserva.val()<=0){
        inputPersonasReserva.addClass("is-invalid");
        inputPersonasReserva.removeClass("is-valid");
        $('#malPersonasReserva').empty();
        $('#malPersonasReserva').append(`Debe ir al menos una persona a la Reserva`);
    }
    else {
        inputPersonasReserva.addClass("is-valid");
        inputPersonasReserva.removeClass("is-invalid");
        personasCorrecto = true;
    }

}

function correctoEditarReserva() {

    return fechaCorrecto &&
        horaCorrecto &&
        personasCorrecto;

}