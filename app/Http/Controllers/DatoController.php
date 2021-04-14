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
        $datos = Dato::join('categorias as cat', 'datos.categoria_key', 'cat.id')
        ->select('datos.id', 'datos.estado', 'datos.titulo', 'datos.contenido', 'datos.url_mas_info', 'datos.url_imagen', 'cat.nombre as categoria')
        ->categoria($request->categoria)
        ->estado($request->estado)
        ->orderBy('datos.categoria_key')->paginate(12);
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
        // dd($request->dato['titulo']);
        $dato = new Dato();
        $dato->titulo = $request->dato['titulo'];
        $dato->contenido = $request->dato['contenido'];
        $dato->url_mas_info = $request->dato['url_mas_info'];
        $dato->url_imagen = $request->dato['url_imagen'];
        $dato->categoria_key = $request->dato['categoria_key'];
        $dato->estado = 2;
        $dato->save();
        return;
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
