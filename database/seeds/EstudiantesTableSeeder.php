<?php

use Illuminate\Database\Seeder;
use App\Estudiante; 

class EstudiantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla
        Estudiante::truncate(); 

        $faker = \Faker\Factory::create(); 

        //Crear estudiantes ficticios en la tabla
        for($i=0; $i<30; $i++){
            Estudiante::create(
                [
                    'nombre' => $faker->sentence, //Varchar --> faker sentence, //Text --> faker paragraph
                    'apellido' => $faker->sentence                             
                ]
            );
        }

    }
}
