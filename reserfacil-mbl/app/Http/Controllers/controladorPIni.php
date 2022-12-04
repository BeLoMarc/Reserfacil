<?php

namespace App\Http\Controllers;

use App\Models\restaurante;
use App\Models\restaurantes;
use Illuminate\Http\Request;
use Error;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class controladorPIni extends Controller
{
    public function Cargardatos()
    {
        // me saca los restaurantes por ahora con el mismo nombre
        //$restauranteUnico = DB::table('restaurantes')->distinct()->get('nombre');
        $restauranteUnico = DB::table('restaurantes')->select('nombre')->distinct()->get();

        //$restaurantes = restaurante::all();
        $restaurantes = DB::table('restaurantes')->orderBy('nombre')->get(); //Devuelve los nombres de los restaurantes
        $categorias = DB::table('categorias')->orderBy('nombre')->get();
        $localidades = DB::table('localidad')->orderBy('nombre')->get();
        $categoriasRestaurante = DB::table('restaurante_categorias')->get();
        $localidadesRestaurante =  DB::table('restaurante_localidad')->get();;
        return view('index', compact('restaurantes', 'restauranteUnico', 'categorias', 'localidades', 'categoriasRestaurante', 'localidadesRestaurante'));
    }
    public function filtracion($r)
    {
        $f = 0;
        if ($r == "v") {
            $f = 1;
        }
        return $f;
    }

    public function Filtro(Request $request)
    {

        if (($request->post('restauranteSelect') != "v") && ($request->post('localidadSelect') != "v") && ($request->post('categoriaSelect') != "v")) { //BUSCA RESTAURANTE LOCALIDAD Y CATEGORIA
            $restaurantes = restaurantes
                ::join("restaurante_localidad", "restaurante_localidad.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->join("restaurante_categorias", "restaurante_categorias.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurante_localidad.codigoLoc', '=', $request->post('localidadSelect')) //Codigo de la localidad(Toledo)
                ->where('restaurante_categorias.codigoCat', '=', $request->post('categoriaSelect')) //Codigo de la categoria(Oriental)
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') == "v") && ($request->post('localidadSelect') != "v") && ($request->post('categoriaSelect') != "v")) { //BUSCA LOCALIDAD Y CATEGORIA
            $restaurantes = restaurantes
                ::join("restaurante_localidad", "restaurante_localidad.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->join("restaurante_categorias", "restaurante_categorias.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurante_localidad.codigoLoc', '=', $request->post('localidadSelect')) //Codigo de la localidad(Toledo)
                ->where('restaurante_categorias.codigoCat', '=', $request->post('categoriaSelect')) //Codigo de la categoria(Oriental)
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') != "v") && ($request->post('localidadSelect') != "v") && ($request->post('categoriaSelect') == "v")) { //BUSCA LOCALIDAD Y RESTAURANTE
            $restaurantes = restaurantes
                ::join("restaurante_localidad", "restaurante_localidad.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurantes.nombre', 'LIKE', '%' .  $request->post('restauranteSelect') . '%') //restaurante de nombre malenia
                ->where('restaurante_localidad.codigoLoc', '=', $request->post('localidadSelect')) //Codigo de la localidad(Toledo)
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') != "v") && ($request->post('localidadSelect') == "v") && ($request->post('categoriaSelect') != "v")) { //BUSCA RESTAURANTE Y CATEGORIA
            $restaurantes = restaurantes
                ::join("restaurante_categorias", "restaurante_categorias.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurantes.nombre', 'LIKE', '%' .  $request->post('restauranteSelect') . '%') //restaurante de nombre malenia
                ->where('restaurante_categorias.codigoCat', '=', $request->post('categoriaSelect')) //Codigo de la categoria(Oriental)
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') != "v") && ($request->post('localidadSelect') == "v") && ($request->post('categoriaSelect') == "v")) { //BUSCA POR RESTAURANTE
            $restaurantes = DB::table('restaurantes')
                ->where('restaurantes.nombre', 'LIKE', '%' .  $request->post('restauranteSelect') . '%') //restaurante de nombre malenia
                ->get();
        } else if (($request->post('restauranteSelect') == "v") && ($request->post('localidadSelect') != "v") && ($request->post('categoriaSelect') != "v")) { //BUSCA POR LOCALIDAD Y CATEGORIA
            $restaurantes = restaurantes
                ::join("restaurante_localidad", "restaurante_localidad.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->join("restaurante_categorias", "restaurante_categorias.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurante_localidad.codigoLoc', '=', $request->post('localidadSelect')) //Codigo de la localidad(Toledo)
                ->where('restaurante_categorias.codigoCat', '=', $request->post('categoriaSelect')) //Codigo de la categoria(Oriental)
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') == "v") && ($request->post('localidadSelect') != "v") && ($request->post('categoriaSelect') == "v")) { //BUSCA POR LOCALIDAD
            $restaurantes = restaurantes
                ::join("restaurante_localidad", "restaurante_localidad.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurante_localidad.codigoLoc', '=', $request->post('localidadSelect')) //Codigo de la localidad(Toledo)
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') == "v") && ($request->post('localidadSelect') == "v") && ($request->post('categoriaSelect') != "v")) { //BUSCA CATEGORIA
            $restaurantes = restaurantes
                ::join("restaurante_categorias", "restaurante_categorias.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurante_categorias.codigoCat', '=', $request->post('categoriaSelect')) //Codigo de la categoria(Oriental)
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') == "v") && ($request->post('localidadSelect') == "v") && ($request->post('categoriaSelect') == "v")) { //BUSCA TODOS
            $restaurantes = DB::table('restaurantes')->orderBy('nombre')->get(); //Devuelve los nombres de los restaurantes

        }
        $categoriasRestaurante = restaurantes
            ::join("restaurante_categorias", "restaurante_categorias.codigoRes", "=", "restaurantes.codigoRestaurante")
            ->join("categorias", "categorias.codigoCategoria", "=", "restaurante_categorias.codigoCat")
            ->select("*")
            ->get();

        $localidadesRestaurante = restaurantes
            ::join("restaurante_localidad", "restaurante_localidad.codigoRes", "=", "restaurantes.codigoRestaurante")
            ->join("localidad", "localidad.codigoLocalidad", "=", "restaurante_localidad.codigoLoc")
            ->select("*")
            ->get();
        //Volvemos a cargar el formulario
        //   $restauranteUnico = DB::table('restaurantes')->distinct()->get('nombre');
        $restauranteUnico = DB::table('restaurantes')->select('nombre')->distinct()->get();

        $categorias = DB::table('categorias')->orderBy('nombre')->get();
        $localidades = DB::table('localidad')->orderBy('nombre')->get();
        return view('index', compact('restaurantes', 'restauranteUnico', 'categorias', 'localidades', 'categoriasRestaurante', 'localidadesRestaurante'));
    }

}
