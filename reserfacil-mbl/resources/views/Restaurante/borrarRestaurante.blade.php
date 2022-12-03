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
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">codigoRestaurante</th>
                    <th scope="col">codigoGerente</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Carta</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono</th>
                </tr>
            </thead>
            @foreach ($restaurantes as $restaurante)
                <tbody>
                    <tr>
                        <th scope="row">{{ $restaurante->codigoRestaurante }}</th>
                        <td>{{ $restaurante->Id }}</td>
                        <td>{{ $restaurante->nombre }}</td>
                        <td>{{ $restaurante->carta }}</td>
                        <td>{{ $restaurante->foto }}</td>
                        <td>{{ $restaurante->direccion }}</td>
                        <td>{{ $restaurante->telefono }}</td>
                    </tr>
                    <tr>
                        <td>
                            
                            <a href="{{ route('restaurante.index') }}" class="btn btn-info">Mostrar Restaurantes</a>
                           
                        </td>
                        <td>
                            <form action="{{ route('restaurante.destroy', $restaurante->codigoRestaurante) }}" method="POST">
                                @csrf
                                @method('DELETE')<!-- ES DE TIPO DELETE PORQUE SIRVE PARA BORRAR -->
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
