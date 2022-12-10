@extends('plantilla/plantillaGerente')
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
        <legend> RESTAURANTE A BORRAR
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Codigo Restaurante</th>
                        <th scope="col">Nombre Restaurante</th>
                        <th scope="col">Codigo Gerente</th>
                        <th scope="col">Carta</th>
                        <th scope="col">Foto</th>
                        <th scope="col">banner</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Telefono</th>
                    </tr>
                </thead>
                @foreach ($restaurantes as $restaurante)
                    <tbody>
                        <tr>
                            <th class="table-secondary" scope="row">{{ $restaurante->codigoRestaurante }}</th>
                            <td class="table-secondary">{{ $restaurante->nombre }}</td>
                            <td class="table-secondary">{{ $restaurante->id }}</td> <!-- codigo Gerente -->
                            <td class="table-secondary">{{ $restaurante->carta }}</td>
                            <td class="table-secondary">{{ $restaurante->foto }}</td>
                            <td class="table-secondary">{{ $restaurante->direccion }}</td>
                            <td class="table-secondary">{{ $restaurante->banner }}</td>
                            <td class="table-secondary">{{ $restaurante->telefono }}</td>

                            <td>

                                <a href="{{ route('restaurante.index') }}" class="btn btn-info">Mostrar Restaurantes</a>

                            </td>
                            <td>
                                <form action="{{ route('restaurante.destroy', $restaurante->codigoRestaurante) }}"
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
