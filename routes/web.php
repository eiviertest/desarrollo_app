<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//Obtener todas las categorias activas
Route::get('categorias', 'CategoriaController@index');
//Almacenar una categoria
Route::post('categorias', 'CategoriaController@store');
//Eliminar una categoria
Route::delete('categorias', 'CategoriaController@destroy');
//Obtener datos interesantes dependiendo de la categoria seleccionada
Route::get('datos_interesantes', 'DatoController@index');
//Almacenar un dato interesante
Route::post('datos_interesantes', 'DatoController@store');
//Rechazar un dato interesante
Route::put('datos_interesantes/rechazar', 'DatoController@updateRechazar');
//Aceptar un dato interesante
Route::put('datos_interesantes/aceptar', 'DatoController@updateRechazar');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
