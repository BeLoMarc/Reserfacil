@extends('plantilla/plantillaGerente')
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
                    <th class="table-danger" scope="col">Codigo Restaurante</th>
                    <th class="table-danger" scope="col">Codigo Gerente</th>
                    <th class="table-danger" scope="col">Nombre Restaurante</th>
                    <th class="table-danger" scope="col">Carta</th>
                    <th class="table-danger" scope="col">Foto</th>
                    <th class="table-danger" scope="col">Direccion</th>
                    <th class="table-danger" scope="col">Telefono</th>
                </tr>
            </thead>
            @foreach ($restaurantes as $restaurante)
                <tbody>
                    <tr>
                        <th class="table-danger" scope="row">{{ $restaurante->codigoRestaurante }}</th>
                        <!-- codigo Gerente -->
                        <td class="table-secondary">{{ $restaurante->Id }}</td>
                        <td class="table-secondary">{{ $restaurante->nombre }}</td>
                        <td class="table-secondary">{{ $restaurante->carta }}</td>
                        <td class="table-secondary">{{ $restaurante->foto }}</td>
                        <td class="table-secondary">{{ $restaurante->direccion }}</td>
                        <td class="table-secondary">{{ $restaurante->telefono }}</td>
                        <td >
                            <form action="{{ route('restaurante.edit', $restaurante->codigoRestaurante) }}" method="post">
                                @csrf
                                <button class="btn btn-info btn-sm">
                                    <span class="fas fa-user-edit">
                                        <i class="bi bi-pencil-square">EDITAR</i>
                                    </span>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('restaurante.show', $restaurante->codigoRestaurante) }}" method="post">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    <span class="fas fa-user-edit">
                                        <i class="bi bi-trash3-fill">ELIMINAR</i>

                                    </span>
                                </button>
                            </form>
                        </td>


                        <!--
                                        <td><a href="{{ route('restaurante.edit') }}" class="btn btn-info">editar Restaurante</a></td>
                                        <td><a href="{{ route('restaurante.show') }}" class="btn btn-danger">eliminar Restaurante</a></td>
                                    -->
                    </tr>
            @endforeach


        </table>
    </div>
@endsection
