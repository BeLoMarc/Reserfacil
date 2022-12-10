<?php

namespace App\Http\Controllers;

use App\Models\restaurante_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Session;

class RestauranteUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //me saca el usuario loggeado para recoger su nombre
        try {
            $id = Auth::user()->id;
        } catch (Throwable $e) {
            $id = Session::get('user');
        }

        $usuario = DB::table('users')
            ->Where('id', '=', $id)
            ->get();

        $reservas = DB::table('restaurante_users')->where('id', '=', $id)->get(); //esto me da las reservas del cliente autenticado
        foreach ($reservas as $re) {
            return view('Reserva.listarReservas', ['reservas'=>$reservas, 'usuario'=>$usuario]);
        }
        return redirect()->route("inicio.inicio")->with("fail", "No tienes ninguna Reserva a tu nombre"); //este es el mensaje que aparece como $mensaje 

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $codigoRes)
    {
      
        $rules = [
            'fecha' => 'required',
            'hora' => 'required', //
            'personas' => 'required|integer', //

        ];
        //mensajes que quiero mandar por si existen errores en la parte servidora
        $messages = [
            'fecha.required' => 'La fecha no puede estar en blanco',
            'hora.required' => 'la hora no puede estar vacia',
            'personas.required' => 'Las personas no pueden estar vacias',
            'persona.integer' => 'Debes introducir un numero de personas',
        ];
        //metodo que necesita de estos 3 argumentos para realizar la validacion
        $this->validate($request, $rules, $messages);



        $res = new restaurante_users();
        $res->codigoRes = $codigoRes; //Codigo del restaurante
        try {
            $res->id = Auth::user()->id; //codigo del cliente
        } catch (Throwable $e) {
            $res->id = Session::get('user'); //codigo del cliente
        }

        $res->fecha = $request->post('fecha'); //fecha
        //parseamos la hora a varchar
        //  $horaBien = date('h:i A', strtotime($request->post('hora'))); //hora
        //  $res->hora = $horaBien;
        $res->hora = $request->post('hora'); //DESCOMENTAR LAS DOS DE ARRIBA SU FALLA
        $res->personas = $request->post('personas'); //cantidad de personas
        $res->nombreRestaurante = $request->post('nombreR');
        $res->save(); //este metodo lo guarda

        return redirect()->route("inicio.inicio")->with("success", "Reserva realizada con exito"); //este es el mensaje que aparece como $mensaje 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\restaurante_users  $restaurante_users
     * @return \Illuminate\Http\Response
     */
    public function show(restaurante_users $restaurante_users, $codres, $fecha)
    {
        try {
            $id = Auth::user()->id;
        } catch (Throwable $e) {
            $id = Session::get('user');
        }
        $reservas = DB::table('restaurante_users')
            ->where('codigoRes', '=', $codres)
            ->where('fecha', '=', $fecha)
            ->where('id', '=', $id) //otra opcion es pasar por parametro la Id
            ->get();

        $usuario = DB::table('users')
            ->Where('id', '=', $id)
            ->get();

        return view('Reserva.borrarReserva', ['reservas'=>$reservas, 'usuario'=>$usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\restaurante_users  $restaurante_users
     * @return \Illuminate\Http\Response
     */
    public function edit($codres, $fecha, $hora)
    {
        try {


            try {
                $id = Auth::user()->id;
            } catch (Throwable $e) {
                $id = Session::get('user');
            }
            $reservas = DB::table('restaurante_users')
                ->where('codigoRes', '=', $codres)
                ->where('fecha', '=', $fecha)
                ->where('hora', '=', $hora)
                ->where('id', '=', $id) //otra opcion es pasar por parametro la Id
                ->get();


            return view('Reserva.editarReserva', ['reservas'=>$reservas]);
        } catch (Throwable $e) {
            return view('inicio.inicio')->with("fail", "Debes iniciar sesion para poder editar el perfil");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\restaurante_users  $restaurante_users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codres, $fecha, $hora)
    {
        try {
            $rules = [
                'fecha' => 'required',
                'hora' => 'required', //
                'personas' => 'required|integer', //

            ];
            //mensajes que quiero mandar por si existen errores en la parte servidora
            $messages = [
                'fecha.required' => 'La fecha no puede estar en blanco',

                'hora.required' => 'la hora no puede estar vacia',
                'personas.required' => 'Las personas no pueden estar vacias',
                'persona.integer' => 'Debes introducir un numero de personas',
            ];
            //metodo que necesita de estos 3 argumentos para realizar la validacion
            $this->validate($request, $rules, $messages);

            try {
                $id = Auth::user()->id;
            } catch (Throwable $e) {
                $id = Session::get('user');
            }

            DB::table('restaurante_users')
                ->where('codigoRes', '=', $codres)
                ->where('fecha', '=', $fecha)
                ->where('hora', '=', $hora)
                ->where('id', '=', $id) //otra opcion es pasar por parametro la Id
                ->update([
                    'fecha' => $request->post('fecha'),
                    'hora' => $request->post('hora'),
                    'personas' => $request->post('personas')
                ]);
            //            $restaurante->save(); //este metodo lo guarda

            return redirect()->route("reserva.index")->with("success", "Actualizado con exito"); //este es el mensaje que aparece como $mensaje en listar restaurante

        } catch (Throwable $e) {
            try {
                $id = Auth::user()->id;
            } catch (Throwable $e) {
                $id = Session::get('user');
            }
            $reservas = DB::table('restaurante_users')
                ->where('codigoRes', '=', $codres)
                ->where('fecha', '=', $fecha)
                ->where('hora', '=', $hora)
                ->where('id', '=', $id) //otra opcion es pasar por parametro la Id
                ->get();
            return view('Reserva.editarReserva', ['reservas'=>$reservas])->with("fail", "No puede realizar mas de una reserva para el mismo dia y la misma hora");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\restaurante_users  $restaurante_users
     * @return \Illuminate\Http\Response
     */
    public function destroy($codres, $fecha, $hora)
    {
        try {
            $id = Auth::user()->id;
        } catch (Throwable $e) {
            $id = Session::get('user');
        }
        DB::table('restaurante_users')
            ->where('codigoRes', '=', $codres)
            ->where('fecha', '=', $fecha)
            ->where('hora', '=', $hora)
            ->where('id', '=', $id) //otra opcion es pasar por parametro la Id
            ->delete();
        return redirect()->route("reserva.index")->with("success", "Reserva cancelada con exito"); //este es el mensaje que aparece como $mensaje 
    }
}
