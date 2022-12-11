<?php

namespace App\Http\Controllers;


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
        
        $restauranteUnico = DB::table('restaurantes')->select('nombre')->distinct()->get();

        
        $restaurantes = DB::table('restaurantes')->orderBy('nombre')->get(); //Devuelve los nombres de los restaurantes
        $categorias = DB::table('categorias')->orderBy('nombre')->get();
        $localidades = DB::table('localidad')->orderBy('nombre')->get();
        $categoriasRestaurante = DB::table('restaurante_categorias')->get();
        $localidadesRestaurante =  DB::table('restaurante_localidad')->get();;
        $restauranteElegido = "v";
        $localidadElegida = "v";
        $categoriaElegida = "v";
        return view('index', [
            'restaurantes' => $restaurantes, 'restauranteUnico' => $restauranteUnico, 'categorias' => $categorias, 'localidades' => $localidades,
            'categoriasRestaurante' => $categoriasRestaurante, 'localidadesRestaurante' => $localidadesRestaurante,
            'restauranteElegido' => $restauranteElegido, 'localidadElegida' => $localidadElegida, 'categoriaElegida' => $categoriaElegida
        ]);
    }

    public function Filtro(Request $request)
    {

        if (($request->post('restauranteSelect') != "v") && ($request->post('localidadSelect') != "v") && ($request->post('categoriaSelect') != "v")) { //BUSCA RESTAURANTE LOCALIDAD Y CATEGORIA
            $restaurantes = restaurantes
                ::join("restaurante_localidad", "restaurante_localidad.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->join("restaurante_categorias", "restaurante_categorias.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurante_localidad.codigoLoc', '=', $request->post('localidadSelect'))
                ->where('restaurante_categorias.codigoCat', '=', $request->post('categoriaSelect'))
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') == "v") && ($request->post('localidadSelect') != "v") && ($request->post('categoriaSelect') != "v")) { //BUSCA LOCALIDAD Y CATEGORIA
            $restaurantes = restaurantes
                ::join("restaurante_localidad", "restaurante_localidad.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->join("restaurante_categorias", "restaurante_categorias.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurante_localidad.codigoLoc', '=', $request->post('localidadSelect')) 
                ->where('restaurante_categorias.codigoCat', '=', $request->post('categoriaSelect'))
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') != "v") && ($request->post('localidadSelect') != "v") && ($request->post('categoriaSelect') == "v")) { //BUSCA LOCALIDAD Y RESTAURANTE
            $restaurantes = restaurantes
                ::join("restaurante_localidad", "restaurante_localidad.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurantes.nombre', 'LIKE', '%' .  $request->post('restauranteSelect') . '%')
                ->where('restaurante_localidad.codigoLoc', '=', $request->post('localidadSelect')) 
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') != "v") && ($request->post('localidadSelect') == "v") && ($request->post('categoriaSelect') != "v")) { //BUSCA RESTAURANTE Y CATEGORIA
            $restaurantes = restaurantes
                ::join("restaurante_categorias", "restaurante_categorias.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurantes.nombre', 'LIKE', '%' .  $request->post('restauranteSelect') . '%') 
                ->where('restaurante_categorias.codigoCat', '=', $request->post('categoriaSelect')) 
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') != "v") && ($request->post('localidadSelect') == "v") && ($request->post('categoriaSelect') == "v")) { //BUSCA POR RESTAURANTE
            $restaurantes = DB::table('restaurantes')
                ->where('restaurantes.nombre', 'LIKE', '%' .  $request->post('restauranteSelect') . '%')
                ->get();
        } else if (($request->post('restauranteSelect') == "v") && ($request->post('localidadSelect') != "v") && ($request->post('categoriaSelect') != "v")) { //BUSCA POR LOCALIDAD Y CATEGORIA
            $restaurantes = restaurantes
                ::join("restaurante_localidad", "restaurante_localidad.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->join("restaurante_categorias", "restaurante_categorias.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurante_localidad.codigoLoc', '=', $request->post('localidadSelect')) 
                ->where('restaurante_categorias.codigoCat', '=', $request->post('categoriaSelect')) 
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') == "v") && ($request->post('localidadSelect') != "v") && ($request->post('categoriaSelect') == "v")) { //BUSCA POR LOCALIDAD
            $restaurantes = restaurantes
                ::join("restaurante_localidad", "restaurante_localidad.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurante_localidad.codigoLoc', '=', $request->post('localidadSelect')) 
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') == "v") && ($request->post('localidadSelect') == "v") && ($request->post('categoriaSelect') != "v")) { //BUSCA CATEGORIA
            $restaurantes = restaurantes
                ::join("restaurante_categorias", "restaurante_categorias.codigoRes", "=", "restaurantes.codigoRestaurante")
                ->where('restaurante_categorias.codigoCat', '=', $request->post('categoriaSelect')) 
                ->select("*")
                ->get();
        } else if (($request->post('restauranteSelect') == "v") && ($request->post('localidadSelect') == "v") && ($request->post('categoriaSelect') == "v")) { //BUSCA TODOS
            $restaurantes = DB::table('restaurantes')->orderBy('nombre')->get(); //Devuelve todos los restaurantes ordenados por nombre

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
      
        $restauranteUnico = DB::table('restaurantes')->select('nombre')->distinct()->get();

        $categorias = DB::table('categorias')->orderBy('nombre')->get();
        $localidades = DB::table('localidad')->orderBy('nombre')->get();
        $restauranteElegido = $request->post('restauranteSelect');
        $localidadElegida = $request->post('localidadSelect');
        $categoriaElegida = $request->post('categoriaSelect');
        return view('index', [
            'restaurantes' => $restaurantes, 'restauranteUnico' => $restauranteUnico, 'categorias' => $categorias, 'localidades' => $localidades,
            'categoriasRestaurante' => $categoriasRestaurante, 'localidadesRestaurante' => $localidadesRestaurante,
            'restauranteElegido' => $restauranteElegido, 'localidadElegida' => $localidadElegida, 'categoriaElegida' => $categoriaElegida
        ]);
    }
}
