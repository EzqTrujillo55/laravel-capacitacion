<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*METODOS HTTP
-GET => 'Nos permite obtener uno o varios recursos' 
SELECT * FROM (Leer todas las filas y todas las columnas)
-POST => 'Nos permite enviar un recuros completo al servidor'
INSERT INTO table VALUES () 
-PUT => 'Nos permite enviar un recurso completo o parcial al servidor' 
UPDATE SQL
-DELETE => 'Nos permite eliminar un recurso' 
DELTE SQL

EXTRA: La principal diferencia entre GET Y POST,
es que con POST podemos enviar información mediante un formulario o request
pero con GET no se puede enviar, solo se puede enviar en la url
*/
//BASE URL = http://localhost:8000/api
Route::get('estudiantes', 'EstudianteController@index');
Route::post('estudiantes', 'EstudianteController@store');
Route::get('estudiantes/{id}', 'EstudianteController@show');
Route::put('estudiantes/{id}', 'EstudianteController@update');
Route::delete('estudiantes/{id}', 'EstudianteController@delete');