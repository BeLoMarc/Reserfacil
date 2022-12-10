@extends('plantilla/plantilla')
@section('formulario')
    @if ($mensaje = Session::get('success'))
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success" role="alert">
                    {{ $mensaje }}
                </div>
            </div>
        </div>
    @endif

    <div class="table table-responsive alert alert-danger" role="alert">
        <legend>RESERVA A CANCELAR
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nombre Restaurante</th>
                        <th scope="col">codigoCliente</th>
                        <th class="table-danger"scope="col">Nombre Cliente</th>

                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Personas</th>
                    </tr>
                </thead>
                @foreach ($reservas as $reserva)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $reserva->nombreRestaurante }}</th>
                            <td>{{ $reserva->id }}</td>
                            @foreach ($usuario as $usu)
                                <td class="table-secondary"> {{ $usu->nombre }} </td>
                            @endforeach
                            <td>{{ $reserva->fecha }}</td>
                            <td>{{ $reserva->hora }}</td>
                            <td>{{ $reserva->personas }}</td>
                     
                            <td>

                                <a href="{{ route('reserva.index') }}" class="btn btn-info">Mostrar Reservas</a>

                            </td>
                            <td>
                                <form
                                    action="{{ route('reserva.destroy', [$reserva->codigoRes, $reserva->fecha, $reserva->hora]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <!-- ES DE TIPO DELETE PORQUE SIRVE PARA BORRAR -->
                                    <button class="btn btn-danger btn-sm">
                                        <span class="fas fa-user-edit">
                                            <i class="bi bi-trash3-fill">ELIMINAR</i>

                                        </span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                @endforeach
            </table>
        </legend>
    </div>
@endsection
