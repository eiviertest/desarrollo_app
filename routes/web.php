<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DatoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

//Obtener todas las categorias
Route::get('categorias', [CategoriaController::class, 'index']);
//Almacenar una categoria
Route::post('categorias/save', [CategoriaController::class, 'store']);
//Eliminar una categoria
Route::delete('categorias/delete', [CategoriaController::class, 'destroy']);
//Obtener datos interesantes dependiendo de la categoria seleccionada
Route::get('datos_interesantes', [DatoController::class, 'index']);
//Almacenar un dato interesante
Route::post('datos_interesantes/store', [DatoController::class, 'store']);
//Rechazar un dato interesante
Route::put('datos_interesantes/rechazar', [DatoController::class, 'updateRechazar']);
//Aceptar un dato interesante
Route::put('datos_interesantes/aceptar', [DatoController::class, 'updateAceptar']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
