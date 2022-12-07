<?php

namespace App\Http\Controllers;

use App\Models\restaurantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Throwable;
class RestaurantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $id = Auth::user()->id;
        } catch (Throwable $e) {
            $id = Session::get('user');
        }
        $restaurantes = DB::table('restaurantes')->where('id', '=',$id)->get();
        //$restaurantes = restaurantes::all();
        foreach ($restaurantes as $re) {
            return view('Restaurante.listarRestaurante', compact('restaurantes'));
        }
        return redirect()->route("inicio.inicio")->with("fail", "No tienes ningun Restaurante que administrar, crea uno primero"); //este es el mensaje que aparece como $mensaje 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = DB::table('categorias')->orderBy('nombre')->get();
        $localidad = DB::table('localidad')->orderBy('nombre')->get();
        return view('Restaurante.crearRestaurante', compact('categorias', 'localidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'carta' => 'required|max:2000',
            'foto' => 'required|max:2000',
            'banner' => 'required|max:2000',
            'nombre' => 'required|max:100',
            'descripcion' => 'required|max:100',
            'direccion' => 'required|max:200',
            'telefono' => 'required|regex:/[0-9]{9}/|max:11',
            'cats' => 'required',
            'locs' => 'required',
        ];
        //mensajes que quiero mandar por si existen errores en la parte servidora
        $messages = [
            'carta.required' => 'La carta del restaurante no puede estar vacia',
            'carta.max' => 'La carta del restaurante no puede Pesar mas de 2MB',
            'foto.required' => 'La foto del restaurante no puede estar vacia',
            'foto.max' => 'La foto del restaurante no puede Pesar mas de 2MB',
            'banner.required' => 'El banner del restaurante no puede estar vacia',
            'banner.max' => 'El banner del restaurante no puede Pesar mas de 2MB',
            'descripcion.required' => 'La descripcion no puede estar vacia',
            'descripcion.max' => 'La descripcion no puede superar los 200 caracteres',
            'nombre.required' => 'El nombre no puede estar vacio',
            'nombre.max' => 'El nombre no puede superar los 200 caracteres',
            'direccion.required' => 'La direccion no puede estar vacia',
            'direccion.max' => 'La direccion no puede superar los 200 caracteres',
            'telefono.required' => 'El telefono no puede estar en blanco',
            'telefono.regex' => 'El telefono debe escribirse con los digitos juntos asi: XXXXXXXXX',
            'telefono.max' => 'El telefono debe No debe exceder los 12 caracteres',
            'cats.required' => 'Debes elegir al menos una categoria',
            'locs.required' => 'Debes elegir al menos una localidad',
        ];
        //metodo que necesita de estos 3 argumentos para realizar la validacion
        $this->validate($request, $rules, $messages);


        $res = new restaurantes();
        try{
             $res->Id =  Auth::user()->id; //Codigo del gerente
        }catch(throwable $e){
            $res->Id=Session::get('user');
        }
       
        $res->nombre = $request->post('nombre'); //nombre del restaurante

        if ($request->hasFile("carta")) {

            $carta = $request->file("carta");
            //esta linea con el slug me cambia el nombre de la foto (que puede ser raro como solo numero o caracteres extraños)
            // y añado la cadena carta-de con el nombre del restaurante y lo sobreescribo para que quede mas bonito
            //y muestro la extension
            $nombreimagencar = Str::slug("carta-de-" . $request->nombre) . "." . $carta->guessExtension();
            $ruta = public_path("Multimedia/cartasRestaurante/");
            //$imagen->move($ruta,$nombreimagen);
            copy($carta->getRealPath(), $ruta . $nombreimagencar);
            $res->carta = $nombreimagencar;
        }
        if ($request->hasFile("foto")) {
            $foto = $request->file("foto");
            $nombreimagenfoto = Str::slug($request->nombre) . "." . $foto->guessExtension();
            $ruta = public_path("Multimedia/fotosRestaurante/");
            //$imagen->move($ruta,$nombreimagen);
            copy($foto->getRealPath(), $ruta . $nombreimagenfoto);
            $res->foto = $nombreimagenfoto;
        }

        if ($request->hasFile("banner")) {

            $banner = $request->file("banner");
            $nombreimagenBanner = Str::slug("banner-de-" . $request->nombre) . "." . $carta->guessExtension();
            $ruta = public_path("Multimedia/bannerRestaurante/");
            //$imagen->move($ruta,$nombreimagen);
            copy($banner->getRealPath(), $ruta . $nombreimagenBanner);
            $res->banner = $nombreimagenBanner;
        }
        $res->descripcion = $request->post('descripcion');
        $res->direccion = $request->post('direccion'); //direccion del restaurante
        $res->telefono = $request->post('telefono'); //numero de telefono del restaurante

        $res->save(); //este metodo lo guarda
        try {
            $id = Auth::user()->id;
        } catch (Throwable $e) {
            $id = Session::get('user');
        }
        
        $cr = DB::table('restaurantes')->select('codigoRestaurante') // aqui busco el codigo del restaurante que acabo de crear
            ->where('id', '=', $id)->orderByDesc('codigoRestaurante')->first();


        $var = $request->post('cats');
        foreach ($var as $cat => $c) { // recorro el array de categorias y las inserto

            DB::table('restaurante_categorias')->insert([

                'codigoRes' => $cr->codigoRestaurante,
                'codigoCat' => $c
            ]);
        }

        foreach ($request->post('locs') as $localidad => $lo) {
            DB::table('restaurante_localidad')->insert([ //recorro el array de localidades y las inserto
                'codigoRes' => $cr->codigoRestaurante,
                'codigoLoc' => $lo
            ]);
        }
        return redirect()->route("restaurante.index")->with("success", "restaurante creado con exito"); //este es el mensaje que aparece como $mensaje en listar restaurante
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    //public function show(restaurante $restaurante)
    public function show($codigoRestaurante)
    {
        $restaurantes = DB::table('restaurantes')->where('codigoRestaurante', '=', $codigoRestaurante)->get();
        return view('Restaurante.borrarRestaurante', compact('restaurantes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    // public function edit(restaurante $restaurante)
    public function edit($codigoRestaurante)
    {
        //me devuelve un objeto restaurante y me busca por codigo restaurante
        $restaurantes = DB::table('restaurantes')->where('codigoRestaurante', '=', $codigoRestaurante)->get();
        //me devuelve las localidades donde se encuentra el restaurante
        $localidadR = DB::table('restaurante_localidad')->where('codigoRes', '=', $codigoRestaurante)->get();
        //creo un array donde guardare los codigos de las localidades donde esta el restaurante
        $locCheck = [];
        foreach ($localidadR as $loc) {

            $locCheck[] = $loc->codigoLoc; //guardo el codigo en este array para mantener los datos en el form
        }
        //me devuelve las categorias a las que pertenece el restaurante
        $categoriasR = DB::table('restaurante_categorias')->where('codigoRes', '=', $codigoRestaurante)->get();
        //creo un array que me guardara los codigo de esas categorias
        $catCheck = [];
        foreach ($categoriasR as $cat) {
            $catCheck[] = $cat->codigoCat; //guardo los codigos
        }
        //me devuelve todas las categorias para pintarlas
        $categorias = DB::table('categorias')->orderBy('nombre')->get();
        //me devuelve todas las localidades para pintarlas
        $localidades = DB::table('localidad')->orderBy('nombre')->get();
        return view('Restaurante.editarRestaurante', compact('restaurantes', 'localidades', 'categorias', 'catCheck', 'locCheck'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, restaurante $restaurante)
    public function update(Request $request, $codigoRestaurante)
    {

        $rules = [
            'carta' => 'required|max:2000',
            'foto' => 'required|max:2000',
            'banner' => 'required|max:2000',
            'nombre' => 'required|max:100',
            'descripcion' => 'required|max:100',
            'direccion' => 'required|max:200',
            'telefono' => 'required|regex:/[0-9]{9}/|max:11',
            'cats' => 'required',
            'locs' => 'required',
        ];
        //mensajes que quiero mandar por si existen errores en la parte servidora
        $messages = [
            'carta.required' => 'La carta del restaurante no puede estar vacia',
            'carta.max' => 'La carta del restaurante no puede Pesar mas de 2MB',
            'foto.required' => 'La foto del restaurante no puede estar vacia',
            'foto.max' => 'La foto del restaurante no puede Pesar mas de 2MB',
            'banner.required' => 'El banner del restaurante no puede estar vacia',
            'banner.max' => 'El banner del restaurante no puede Pesar mas de 2MB',
            'descripcion.required' => 'La descripcion no puede estar vacia',
            'descripcion.max' => 'La descripcion no puede superar los 200 caracteres',
            'nombre.required' => 'El nombre no puede estar vacio',
            'nombre.max' => 'El nombre no puede superar los 200 caracteres',
            'direccion.required' => 'La direccion no puede estar vacia',
            'direccion.max' => 'La direccion no puede superar los 200 caracteres',
            'telefono.required' => 'El telefono no puede estar en blanco',
            'telefono.regex' => 'El telefono debe escribirse con los digitos juntos asi: XXXXXXXXX',
            'telefono.max' => 'El telefono debe No debe exceder los 12 caracteres',
            'cats.required' => 'Debes elegir al menos una categoria',
            'locs.required' => 'Debes elegir al menos una localidad',
        ];
        //metodo que necesita de estos 3 argumentos para realizar la validacion
        $this->validate($request, $rules, $messages);


        if ($request->hasFile("carta")) {
            $carta = $request->file("carta");
            //esta linea con el slug me cambia el nombre de la foto (que puede ser raro como solo numero o caracteres extraños)
            // y cojo el nombre del restaurante y lo sobreescribo
            //y muestro la extension
            $nombreimagencar = Str::slug("carta-de-" . $request->nombre) . "." . $carta->guessExtension();
            $ruta = public_path("Multimedia/cartasRestaurante/");
            //$imagen->move($ruta,$nombreimagen);
            copy($carta->getRealPath(), $ruta . $nombreimagencar);
            // $restaurante->carta = $nombreimagen;
        }
        if ($request->hasFile("foto")) {
            $foto = $request->file("foto");
            $nombreimagenfoto = Str::slug($request->nombre) . "." . $foto->guessExtension();
            $ruta = public_path("Multimedia/fotosRestaurante/");
            copy($foto->getRealPath(), $ruta . $nombreimagenfoto);
        }
        if ($request->hasFile("banner")) {

            $banner = $request->file("banner");
            $nombreimagenBanner = Str::slug("banner-de-" . $request->nombre) . "." . $carta->guessExtension();
            $ruta = public_path("Multimedia/bannerRestaurante/");
            //$imagen->move($ruta,$nombreimagen);
            copy($banner->getRealPath(), $ruta . $nombreimagenBanner);
        }
        DB::table('restaurantes')
            ->where('codigoRestaurante', $codigoRestaurante)
            ->update(
                [
                    // 'codigoGer' => $request->post('codigoGer'),
                    'nombre' => $request->post('nombre'),
                    'carta' => $nombreimagencar,
                    'foto' => $nombreimagenfoto,
                    'banner' => $nombreimagenBanner,
                    'descripcion' => $request->post('descripcion'),
                    'direccion' => $request->post('direccion'),
                    'telefono' => $request->post('telefono')
                ]
            );
        $cr = $request->post('codigoRestaurante'); //aqui guardo el codigo del restaurante, lo recojo de un campo hidden

        $locBorrar = DB::table('restaurante_localidad')->where('codigoRes', '=', $cr)->get(); //hago la busqueda de las localidades donde esta el restaurante a editar

        $lc = $request->post('locs'); //guardo en un array las localidades donde digo que esta el restaurante

        foreach ($locBorrar as $item) { //recorro la busqueda de antes mirando las localidades donde se encontraba el restaurante
            if (!in_array($item->codigoLoc, $lc)) { //ahora si donde estaba antes no esta en el array de actualizacio, quiere decir que ese restaurante ya
                DB::table('restaurante_localidad') //no esta en esa localidad por tanto lo borro
                    ->where('codigoLoc', '=', $item->codigoLoc)
                    ->where('codigoRes', '=', $cr)->delete();
            }
        }
        foreach ($lc as $l => $loc) {
            DB::table('restaurante_localidad')->upsert( //ahora recorro el array donde si que esta el restaurante
                ['codigoLoc' => $loc, 'codigoRes' => $cr], //mediante el upsert, mantengo las localidades donde ya estaba e inserto las nuevas
                ['codigoLoc' => $loc]
            );
        }

        //OBJETO
        $catBorrar = DB::table('restaurante_categorias')->where('codigoRes', '=', $cr)->get(); //buco todas las categorias a las que pertenecia el restaurante
        //ARRAY
        $cb = $request->post('cats'); //en este array estan las nuevas categorias donde quiero que se encuentre
        foreach ($catBorrar as $item) { //las comparo y si donde estaban antes ahora no, quiere decir que ya no pertenecen a dicha categoria
            if (!in_array($item->codigoCat, $cb)) { //por tanto las elimino
                DB::table('restaurante_categorias')
                    ->where('codigoCat', '=', $item->codigoCat)
                    ->where('codigoRes', '=', $cr)->delete();
            }
        }

        foreach ($cb as $l => $catB) {
            DB::table('restaurante_categorias')->upsert( //recorro las categorias donde se debe encotrar el restaurante y las actualizo o las inserto
                ['codigoCat' => $catB, 'codigoRes' => $cr], //dependiendo de la necesidad
                ['codigoCat' => $catB]
            );
        }

        return redirect()->route("restaurante.index")->with("success", "Restaurante actualizado con exito"); //este es el mensaje que aparece como $mensaje en listar restaurante
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    //public function destroy(restaurante $restaurante)
    public function destroy($codigoRestaurante)
    {
        DB::table('restaurante_localidad')->where('codigoRes', '=', $codigoRestaurante)->delete(); //primero se deben borrar las tablas con dependencia

        DB::table('restaurante_categorias')->where('codigoRes', '=', $codigoRestaurante)->delete(); //primero se deben borrar las tablas con dependencia

        DB::table('restaurantes')->where('codigoRestaurante', '=', $codigoRestaurante)->delete(); //se borra la tabla padre

        return redirect()->route("restaurante.index")->with("success", "Restaurante eliminado con exito");
    }

    public function mostarInfoRestaurante($codigoRestaurante) //codigo del restaurante elegido
    {
        // $restauranteUnico = DB::table('restaurantes')->distinct()->get('nombre');
        $restauranteUnico = DB::table('restaurantes')->select('nombre')->distinct()->get();
        $categorias = DB::table('categorias')->orderBy('nombre')->get();
        $localidades = DB::table('localidad')->orderBy('nombre')->get();

        // saca todos los restaurantes ordenador por nombre
        $restaurantes = DB::table('restaurantes')
            ->orderBy('nombre')
            ->get();
        // saca todos los restaurantes ordenador por nombre
        $restauranteElegido = DB::table('restaurantes')
            ->where('codigoRestaurante', $codigoRestaurante)
            ->get();
        $categoriasRestaurante = DB::table('restaurante_categorias')->get();
        $localidadesRestaurante =  DB::table('restaurante_localidad')->get();;
        return view('infoRestaurante', compact('restaurantes', 'restauranteUnico', 'categorias', 'localidades', 'restauranteElegido', 'categoriasRestaurante', 'localidadesRestaurante'));
    }
}
