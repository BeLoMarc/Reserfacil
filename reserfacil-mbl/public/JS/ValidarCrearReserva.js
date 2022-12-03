'use Strict'
let fechaCorrecto;
let horaCorrecto;
let personasCorrecto;

$('#main').on('click', '#botonCrearReserva', function (event) {
    console.log("Dentro del metodo de reataurante")
    event.preventDefault();
    validarcrearReserva();
    if (correctoCrearReserva()) {
        $("#crearReserva").submit();
    }
});


function validarcrearReserva() {
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
    } else if ((Date.parse(inputFechaReserva.val()) + parseInt(89940000)) < Date.now()) {//lo que sumo son 23 horas y 59 minutos
        inputFechaReserva.addClass("is-invalid");
        inputFechaReserva.removeClass("is-valid");
        $('#malFechaReserva').empty();
        $('#malFechaReserva').append(`No puedes hacer una reserva en un dia pasado`);
    }
    else {
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

    } else if (inputPersonasReserva.val() <= 0) {
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

function correctoCrearReserva() {

    return fechaCorrecto &&
        horaCorrecto &&
        personasCorrecto;

}