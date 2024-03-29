@extends('plantilla/plantilla')
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
    <div class="table table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>

                    <th class="table-danger"scope="col">Nombre Restaurante</th>
                    <th class="table-danger"scope="col">Codigo Cliente</th>
                    <th class="table-danger"scope="col">Nombre Cliente</th>
                    <th class="table-danger"scope="col">Fecha</th>
                    <th class="table-danger" scope="col">Hora</th>
                    <th class="table-danger"scope="col">Personas</th>
                </tr>


            </thead>
            @foreach ($reservas as $reserva)
                <tbody>
                    <tr>

                        <td class="table-secondary">{{ $reserva->nombreRestaurante }}</td>
                        <td class="table-secondary">{{ $reserva->id }}</td>
                        @foreach ($usuario as $usu)
                            <td class="table-secondary"> {{ $usu->nombre }} </td>
                        @endforeach
                        <td class="table-secondary">{{ $reserva->fecha }}</td>
                        <td class="table-secondary">{{ $reserva->hora }}</td>
                        <td class="table-secondary">{{ $reserva->personas }}</td>
                        <td>
                            <form
                                action="{{ route('reserva.edit', [$reserva->codigoRes, $reserva->fecha, $reserva->hora]) }}"
                                method="post">
                                @csrf
                                <button class="btn btn-info btn-sm">
                                    <span class="fas fa-user-edit">
                                        <i class="bi bi-pencil-square">EDITAR</i>
                                    </span>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form
                                action="{{ route('reserva.show', [$reserva->codigoRes, $reserva->fecha, $reserva->hora]) }}"
                                method="post">
                                @csrf
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
