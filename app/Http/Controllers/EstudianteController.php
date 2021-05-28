<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante; 

class EstudianteController extends Controller
{
    //Método index, va a retornar todos los registros.
    public function index(){
        return Estudiante::all(); //SELECT * FROM estudiantes
    }

    //Método store, permite almacenar un registro
    //Request->all() , recoge todos los datos enviados por el usuario
    //Y lo convierte en un array asociativo
    public function store(Request $request){
        return Estudiante::create($request->all()); //INSERT INTO estudiantes VALUES request
    }


    public function show($id){
        return Estudiante::find($id); //SELECT * FROM estudiantes WHERE id=$id
    }

    public function update(Request $request, $id){
        $estudiante = Estudiante::findOrFail($id); //Obtiene el estudiante mediante el id
        $estudiante->update($request->all());  //Actualiza el estudiante encontrado con el request
        return $estudiante;  //Retorna el estudiante actualizado
    }

    public function delete($id){
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->delete(); 
        return 204; 
    }
}
