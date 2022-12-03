<?php

namespace App\Http\Controllers;

use App\Models\restaurante_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class RestauranteUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //me saca el usuario loggeado para recoger su nombre
        $usuario = DB::table('users')->where('Id', '=', Auth::user()->Id)->get();
        $reservas = restaurante_users::all(); //Esta query es para que me saque todas las reservas,
        // pero en el nombre del cliente pone el mismo porque coge el que esta actualmente loggeado

        //Esto esta hecho al recoger la sesion a mano
        // if (Session::get('user') !== null) {
        //     $a=Session::get('user');
        //     $usuario = DB::table('users')->where('remember_token', 'LIKE', '%'.$a.'%')->get();
        //     $reservas = DB::table('restaurante_users')->where('Id', '=', $usuario[0]->Id)->get(); //esto me da las reservas del cliente autenticado
        // }



        return view('Reserva.listarReservas', compact('reservas', 'usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $codigoRes)
    {
        // $request->validate([
        //     'fecha' => 'required',
        //     'hora' => 'required',
        //     'personas' => 'required',
        //]);
        try {
            //$hoy = date('Y/m/d'); |date|date_format:Y/m/d    ,doesnt_start_with:-,0
            //Solo los datos requeridos
            $rules = [
                'fecha' => 'required',
                'hora' => 'required', //
                'personas' => 'required', //

            ];
            //mensajes que quiero mandar por si existen errores en la parte servidora
            $messages = [
                'fecha.required' => 'La fecha no puede estar en blanco',
                'fecha.after_or_equal' => 'Debes elegir una a partir de hoy',
                'hora.required' => 'la hora no puede estar vacia',
                'personas.required' => 'Las personas no pueden estar vacias',
                'personas.doesnt_start_with' => 'Debe ir al menos una persona a la reserva',
            ];
            //metodo que necesita de estos 3 argumentos para realizar la validacion
            $this->validate($request, $rules, $messages);



            $res = new restaurante_users();
            $res->codigoRes = $codigoRes; //Codigo del restaurante
            //$res->nombreRes = $nombreRes; Nombre del restaurante en la vista mostrarInfo

            $res->Id = Auth::user()->Id; //codigo del cliente
            $res->fecha = $request->post('fecha'); //fecha
            //parseamos la hora a varchar
            //  $horaBien = date('h:i A', strtotime($request->post('hora'))); //hora
            //  $res->hora = $horaBien;
            $res->hora = $request->post('hora'); //DESCOMENTAR LAS DOS DE ARRIBA SU FALLA
            $res->personas = $request->post('personas'); //cantidad de personas
            $res->nombreRestaurante = $request->post('nombreR');
            $res->save(); //este metodo lo guarda

            return redirect()->route("inicio.inicio")->with("success", "Reserva realizada con exito"); //este es el mensaje que aparece como $mensaje 
        } catch (Throwable $e) {
            return redirect()->route("inicio.inicio")->with("fail", "No puede realizar mas de una reserva para el mismo dia y la misma hora o no se ha regitrado");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\restaurante_users  $restaurante_users
     * @return \Illuminate\Http\Response
     */
    public function show(restaurante_users $restaurante_users, $codres, $fecha)
    {
        $reservas = DB::table('restaurante_users')
            ->where('codigoRes', '=', $codres)
            ->where('fecha', '=', $fecha)
            ->where('Id', '=', Auth::user()->Id) //otra opcion es pasar por parametro la Id
            ->get();
        return view('Reserva.borrarReserva', compact('reservas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\restaurante_users  $restaurante_users
     * @return \Illuminate\Http\Response
     */
    public function edit($codres, $fecha, $hora)
    {

        $reservas = DB::table('restaurante_users')
            ->where('codigoRes', '=', $codres)
            ->where('fecha', '=', $fecha)
            ->where('hora', '=', $hora)
            ->where('Id', '=', Auth::user()->Id) //otra opcion es pasar por parametro la Id
            ->get();
        return view('Reserva.editarReserva', compact('reservas'));
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
        //solo muestra las del cliente que haya reservado.
        //en el listar salen todas, pero a la hora de editar van ligadas con el usuario, por tanto el usuario de Id 5 no podria editar la de otro diferente
        //  $request->validate([
        //     'fecha' => 'required',
        //    'hora' => 'required',
        //  'personas' => 'required',
        //]);
        try {
            $rules = [
                'fecha' => 'required',
                'hora' => 'required', //
                'personas' => 'required', //

            ];
            //mensajes que quiero mandar por si existen errores en la parte servidora
            $messages = [
                'fecha.required' => 'La fecha no puede estar en blanco',
                'fecha.after_or_equal' => 'Debes elegir una a partir de hoy',
                'hora.required' => 'la hora no puede estar vacia',
                'personas.required' => 'Las personas no pueden estar vacias',
                'personas.doesnt_start_with' => 'Debe ir al menos una persona a la reserva',
            ];
            //metodo que necesita de estos 3 argumentos para realizar la validacion
            $this->validate($request, $rules, $messages);



            DB::table('restaurante_users')
                ->where('codigoRes', '=', $codres)
                ->where('fecha', '=', $fecha)
                ->where('hora', '=', $hora)
                ->where('Id', '=', Auth::user()->Id) //otra opcion es pasar por parametro la Id
                ->update([
                    'fecha' => $request->post('fecha'),
                    'hora' => $request->post('hora'),
                    'personas' => $request->post('personas')
                ]);
            //            $restaurante->save(); //este metodo lo guarda

            return redirect()->route("reserva.index")->with("success", "Actualizado con exito"); //este es el mensaje que aparece como $mensaje en listar restaurante

        } catch (Throwable $e) {
            $reservas = DB::table('restaurante_users')
                ->where('codigoRes', '=', $codres)
                ->where('fecha', '=', $fecha)
                ->where('hora', '=', $hora)
                ->where('Id', '=', Auth::user()->Id) //otra opcion es pasar por parametro la Id
                ->get();
            return view('Reserva.editarReserva', compact('reservas'))->with("fail", "No puede realizar mas de una reserva para el mismo dia y la misma hora");
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
        DB::table('restaurante_users')
            ->where('codigoRes', '=', $codres)
            ->where('fecha', '=', $fecha)
            ->where('hora', '=', $hora)
            ->where('Id', '=', Auth::user()->Id) //otra opcion es pasar por parametro la Id
            ->delete();
        return redirect()->route("inicio.inicio")->with("success", "Reserva cancelada con exito"); //este es el mensaje que aparece como $mensaje 
    }
}
