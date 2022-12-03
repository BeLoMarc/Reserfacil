@extends('plantilla/plantilla')
@section('formulario')
    <div class="row">
        <div class="col-sm-12">
            @if ($mensaje = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $mensaje }}
                </div>
            @endif


        </div>
    </div>
    <div class="table table-responsive alert alert-danger" role="alert">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">codigoRestaurante</th>
                    <th scope="col">codigoCliente</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Personas</th>
                </tr>
            </thead>
            @foreach ($reservas as $reserva)
                <tbody>
                    <tr>
                        <th scope="row">{{ $reserva->codigoRes }}</th>
                        <td>{{ $reserva->Id }}</td>
                        <td>{{ $reserva->fecha }}</td>
                        <td>{{ $reserva->hora }}</td>
                        <td>{{ $reserva->personas }}</td>
                    </tr>
                    <tr>
                        <td>

                            <a href="{{ route('reserva.index') }}" class="btn btn-info">Mostrar Reservas</a>

                        </td>
                        <td>
                            <form action="{{ route('reserva.destroy', [$reserva->codigoRes,$reserva->fecha,$reserva->hora]) }}"
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
    </div>
@endsection
