<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use PhpParser\Node\Stmt\TryCatch;
use App\Exceptions\Handler;
use Throwable;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(user $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //
    }


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
        // $request->validate([
        //     'nombre' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        //     'telefono' => 'required',
        // ]);
        try {
            $rules = [
                'nombre' => 'required|max:200',
                'password' => 'required|max:200',
                'email' => ['required', 'regex:/^.+@.+$/i', 'unique:users,email'], //es un email requerido, debe pasar por la regex,Debe existir en la BBDD', //es un email requerido, debe pasar por la regex, no valido si tiene que existir porque si lo quiere mantener, saltara la excepcion
                'telefono' => ['required', 'regex:/[0-9]{9}/', 'max:11'],
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


            //mas facil para asignar roles
            $cliente = User::create([
                // 'id' => 0,
                'nombre' => $request->post('nombre'),
                'email' => $request->post('email'),
                'password' => Hash::make($request->post('password')),
                'telefono' => $request->post('telefono'),
            ]);
            $cliente->assignRole('cliente');

            $cliente->save();
            //Esto es lo nuevo
            event(new Registered($cliente));

            Auth::login($cliente, true);

            Session::put('user', Auth::user()->Id);
            Session::put('admin', Auth::user()->isAdmin);

            // $cli = new User();
            // $cli->id = 0;
            // $cli->nombre = $request->post('nombre');
            // $cli->email = $request->post('email');
            // $cli->password = Hash::make($request->post('password'));
            // $cli->telefono = $request->post('telefono');
            // $cli->save(); //este metodo lo guarda
            // Auth::login($cli, true);
            //return redirect()->route("inicio.inicio")->with("success", $cliente->getRoleNames()); //este mensaje me dice los roles del usuario creado en este caso cliente
            return redirect()->route("inicio.inicio")->with("success", "Disfruta de nuestra aplicacion D.ª" . Auth::user()->nombre . ", perteneces al grupo " . $cliente->getRoleNames());
        } catch (Throwable $e) {
            return redirect()->route("inicio.inicio")->with("fail", "El email introducido ya esta en uso. Elija otro");
        }
    }
    public function logginRegistroCliente()
    {
        return view('Usuario.formularioLogginCliente');
    }

    public function autenticarCliente(LoginRequest $request)
    {

        try {
            //Reglas de validacion
            $rules = [
                'password' => 'required|max:200',
                'email' => 'required|regex:/^.+@.+$/i|exists:users,email', //es un email requerido, debe pasar por la regex,Debe existir en la BBDD', //es un email requerido, debe pasar por la regex, no valido si tiene que existir porque si lo quiere mantener, saltara la excepcion
            ];
            //mensajes que quiero mandar por si existen errores en la parte servidora
            $messages = [
                'password.required' => 'la contraseña no puede estar vacia',
                'password.max' => 'la contraseña no puede exceder los 200 caracteres',
                'email.required' => 'El email no puede estar en blanco',
                'email.exist' => 'No existe ningun usuario ligado al correo introducido, pruebe otro diferente',
                'email.regex' => 'El email debe escribirse manteniendo esta estructura: Nombre@ejemplo.com',
            ];
            //metodo que necesita de estos 3 argumentos para realizar la validacion            
            $this->validate($request, $rules, $messages);

            $credentials = [
                "email" => $request->email,
                "password" => $request->password,

            ];
            if (Auth::attempt($credentials, true)) {


                $request->authenticate();
                $request->session()->regenerate();
                Session::put('user', Auth::user()->Id);
                Session::put('admin', Auth::user()->isAdmin);
                //  $b=Session::get('admin');
                //  $a=Session::get('user');
                Session::save();

           
                return redirect()->route("inicio.inicio")->with("success", "Bienvenido de nuevo D.ª " . Auth::user()->nombre); //este es el mensaje que aparece como $mensaje en listar restaurante

            }
            return redirect()->route("Usuario.formularioLogginCliente")->with("fail", "No ha sido posible iniciar Sesion, correo o contraseña incorrectos");
            // return back()->withErrors([
            //    'email' => 'The provided credentials do not match our records.',
            //])->onlyInput('email');
        } catch (Throwable $e) {
            return redirect()->route("inicio.inicio")->with("fail", "Error en el servidor, pongase en contacto con el administrador");
        }
    }

    public function logOut(Request $request)
    {
        Auth::logout();

        Session::forget('user');

        Session::forget('admin');

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("inicio.inicio");
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function showCliente(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function editCliente(User $User)
    {
        //$cliente = DB::table('users')->where('Id', '=',  Auth::user()->Id)->get();

        //return view('editarCliente', compact('cliente'));
        return view('Usuario.editarCliente');
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
        // $request->validate([
        //     'nombre' => 'required',
        //     'email' => 'required|regex:/^.+@.+$/i|unique:users,email',//es un email requerido, debe pasar por la regex y ademas no tiene q existir
        //     'telefono' => 'required',
        // ]);

        //Reglas de validacion
        try {
            $rules = [
                'nombre' => 'required|max:200',
                'email' => 'required|regex:/^.+@.+$/i', //es un email requerido, debe pasar por la regex, no valido si tiene que existir porque si lo quiere mantener, saltara la excepcion
                'telefono' => 'required|regex:/[0-9]{9}/|max:11',
            ];
            //mensajes que quiero mandar por si existen errores en la parte servidora
            $messages = [
                'nombre.required' => 'El nombre no puede estar en blanco',
                'nombre.max' => 'La longitud del nombre no puede exceder los 200 caracteres',
                'email.required' => 'El email no puede estar en blanco',
                'email.regex' => 'El email debe escribirse manteniendo esta estructura: Nombre@ejemplo.com',
                'telefono.required' => 'El telefono no puede estar en blanco',
                'telefono.regex' => 'El telefono debe escribirse con los digitos juntos asi: XXXXXXXXX',
                'telefono.max' => 'El telefono debe No debe exceder los 12 caracteres',
            ];
            //metodo que necesita de estos 3 argumentos para realizar la validacion
            $this->validate($request, $rules, $messages);


            DB::table('users')
                ->where('Id', $id)
                ->update(
                    [
                        // 'codigoGer' => $request->post('codigoGer'),
                        'nombre' => $request->post('nombre'),
                        'email' => $request->post('email'),
                        'telefono' => $request->post('telefono')
                    ]
                );

            return redirect()->route("inicio.inicio")->with("success", "Actualizado con exito"); //este es el mensaje que aparece como $mensaje en listar restaurante
        } catch (Throwable $e) {
            return redirect()->route("cliente.edit")->with("fail", "Error en el servidor. Pongase en contacto con el administrador");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroyCliente(User $User)
    {
        //
    }
}
