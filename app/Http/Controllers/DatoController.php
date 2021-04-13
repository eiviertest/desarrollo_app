<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dato;

class DatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $datos = Dato::join('categoria as cat', 'datos.categoria_key', 'cat.id')
        ->select('datos.titulo', 'datos.contenido', 'datos.url_mas_info', 'datos.url_imagen', 'cat.nombre as categoria')
        ->where('cat.nombre', $request->categoria)
        ->where('datos.estado', 1)
        ->orderBy('datos.categoria_key')->paginate(10);
        return [
            'pagination' => [
                'total' => $datos->total(),
                'current_page' => $datos->currentPage(),
                'per_page' => $datos->perPage(),
                'last_page' => $datos->lastPage(),
                'from' => $datos->firstItem(),
                'to' => $datos->lastItem()
            ],
            'datos' => $datos
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $dato = new Dato();
        $dato->titulo = $request->titulo;
        $dato->contenido = $request->contenido;
        $dato->url_mas_info = $request->url_mas_info;
        $dato->url_imagen = $request->url_imagen;
        $dato->categoria_key = $request->categoria_key;
        $dato->estado = 2;
        $dato->save();
    }

    /**
     * Update the specified resource in storage to accept it.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAceptar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $dato = Dato::findOrFail($request->id);
        $dato->estado = 1;
        $dato->save();
    }

    /**
     * Update the specified resource in storage to reject it.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateRechazar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $dato = Dato::findOrFail($request->id);
        $dato->estado = 0;
        $dato->save();
    }

}
