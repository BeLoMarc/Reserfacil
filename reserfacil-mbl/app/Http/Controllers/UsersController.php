<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCliente()
    {
        return view('Usuario.crearCliente');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCliente(Request $request)
    {
       
        $rules = [
            'nombre' => 'required|max:200',
            'password' => 'required|max:200',
            'email' => ['required', 'regex:/^.+@.+$/i', 'unique:users,email'], //es un email requerido, debe pasar por la regex,Debe ser unico en la BBDD', //es un email requerido, debe pasar por la regex, no valido si tiene que existir porque si lo quiere mantener, saltara la excepcion
            'telefono' => ['required', 'regex:/[0-9]{9}/', 'max:9'],
        ];
        //mensajes que quiero mandar por si existen errores en la parte servidora
        $messages = [
            'nombre.required' => 'El nombre no puede estar en blanco',
            'nombre.max' => 'La longitud del nombre no puede exceder los 200 caracteres',
            'password.required' => 'la contraseña no puede estar vacia',
            'password.max' => 'la contraseña no puede exceder los 200 caracteres',
            'email.required' => 'El email no puede estar en blanco',
            'email.unique' => 'Ya existe un usuario con ese mismo Email, por favor cambielo',
            'email.regex' => 'El email debe escribirse manteniendo esta estructura: Nombre@ejemplo.com',
            'telefono.required' => 'El telefono no puede estar en blanco',
            'telefono.regex' => 'El telefono debe escribirse con los digitos juntos asi: XXXXXXXXX',
        ];
        //metodo que necesita de estos 3 argumentos para realizar la validacion
        $this->validate($request, $rules, $messages);


        $request->post('nombre');

        $users = DB::table('users')->count();
        $users = $users + 1;
        $cliente = User::create([
            'id' => $users,
            'nombre' => $request->post('nombre'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'telefono' => $request->post('telefono'),
        ]);
        $cliente->assignRole('cliente');

        $cliente->save();
    

        Auth::login($cliente);
        $credentials = [
            "email" => $request->post('email'),
            "password" => $request->post('password'),

        ];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Session::put('user', Auth::user()->id);
            Session::put('admin', Auth::user()->isAdmin);
    
            Session::save();
        }
         return redirect()->route("inicio.inicio")->with("success", "Disfruta de nuestra aplicacion D.ª" . Auth::user()->nombre . ", perteneces al grupo " . $cliente->getRoleNames());
       
    }
    public function logginRegistroCliente()
    {
        return view('Usuario.formularioLogginCliente');
    }

    public function autenticarCliente(LoginRequest $request)
    {
        $rules = [
            'password' => 'required|max:200',
            'email' => 'exists:users,email', //es un email requerido, debe pasar por la regex,Debe existir en la BBDD', //es un email requerido, debe pasar por la regex, no valido si tiene que existir porque si lo quiere mantener, saltara la excepcion
        ];
        //mensajes que quiero mandar por si existen errores en la parte servidora
        $messages = [
            'password.required' => 'la contraseña no puede estar vacia',
            'password.max' => 'la contraseña no puede exceder los 200 caracteres',
            'email.required' => 'El email no puede estar en blanco',
            'email.exists' => 'No existe ningun usuario ligado al correo introducido, pruebe otro diferente',
            'email.regex' => 'El email debe escribirse manteniendo esta estructura: Nombre@ejemplo.com',
        ];
        //metodo que necesita de estos 3 argumentos para realizar la validacion            
        $this->validate($request, $rules, $messages);

        $credentials = [
            "email" => $request->email,
            "password" => $request->password,

        ];
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            Session::put('user', Auth::user()->id);
            Session::put('admin', Auth::user()->isAdmin);
           
            Session::save();


            return redirect()->route("inicio.inicio")->with("success", "Bienvenido de nuevo D.ª " . Auth::user()->nombre); //este es el mensaje que aparece como $mensaje en listar restaurante

        }
        return redirect()->route("cliente.logginRegistroCliente")->with("fail", "No ha sido posible iniciar Sesion, correo o contraseña incorrectos");
    }

    public function logOut(Request $request)
    {
        Auth::logout();

        Session::forget('user');

        Session::forget('admin');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("inicio.inicio");
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function editCliente()
    {
        $cliente = DB::table('users')->where('id', '=',  Session::get('user'))->get();

        
        return view('Usuario.editarCliente', ['cliente'=>$cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function updateCliente(Request $request, $id)
    {
       
        $rules = [
            'nombre' => 'required|max:200',
            'email' => 'required|regex:/^.+@.+$/i', //es un email requerido, debe pasar por la regex, no valido si tiene que existir porque si lo quiere mantener, saltara la excepcion
            'telefono' => 'required|regex:/[0-9]{9}/|max:9',
        ];
        //mensajes que quiero mandar por si existen errores en la parte servidora
        $messages = [
            'nombre.required' => 'El nombre no puede estar en blanco',
            'nombre.max' => 'La longitud del nombre no puede exceder los 200 caracteres',
            'email.required' => 'El email no puede estar en blanco',
            'email.regex' => 'El email debe escribirse manteniendo esta estructura: Nombre@ejemplo.com',
            'telefono.required' => 'El telefono no puede estar en blanco',
            'telefono.regex' => 'El telefono debe escribirse con los digitos juntos asi: XXXXXXXXX',
            'telefono.max' => 'El telefono debe No debe exceder los 9 caracteres',
        ];
        //metodo que necesita de estos 3 argumentos para realizar la validacion
        $this->validate($request, $rules, $messages);


        DB::table('users')
            ->where('id', $id)
            ->update(
                [
                  
                    'nombre' => $request->post('nombre'),
                    'email' => $request->post('email'),
                    'telefono' => $request->post('telefono')
                ]
            );

        return redirect()->route("inicio.inicio")->with("success", "Actualizado con exito"); //este es el mensaje que aparece como $mensaje en listar restaurante
       
    }

  
}
