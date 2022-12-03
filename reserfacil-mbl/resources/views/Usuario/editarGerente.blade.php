@extends('plantilla/plantilla')
@section('formulario')
    <form>
        <div class="mb-3">
            @foreach ($datos as $dato)
                <label for="exampleInputEmail1" class="form-label">Formulario de registro de Gerente:</label>
               
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Correo Electronico" value="{{$dato->email}}">
        </div>
        <div class="mb-3">

            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" value="{{$dato->contraseña}}">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nombre" aria-label="Recipient's username"
                aria-describedby="button-addon2 value="{{$dato->nombre}}"">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Apellido1" aria-label="Recipient's username"
                aria-describedby="button-addon2" value="{{$dato->apellido1}}">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Apellido2" aria-label="Recipient's username"
                aria-describedby="button-addon2" value="{{$dato->apellido2}}">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="DNI" aria-label="Recipient's username"
                aria-describedby="button-addon2" value="{{$dato->DNI}}">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Direccion" aria-label="Recipient's username"
                aria-describedby="button-addon2" value="{{$dato->direccion}}">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Telefono" aria-label="Recipient's username"
                aria-describedby="button-addon2" value="{{$dato->telefono}}">
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
