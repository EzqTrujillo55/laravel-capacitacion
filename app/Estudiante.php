<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    //Cuando deseo que estos campos sean llenables
    protected $fillable = ['nombre', 'apellido'];
    

}
