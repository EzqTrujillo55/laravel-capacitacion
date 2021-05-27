<?php

use Illuminate\Http\Request;
use App\Estudiante; 
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
*/

Route::get('estudiantes', function(){
    return Estudiante::all(); //SELECT * FROM estudiantes
});
