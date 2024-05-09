<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Classe::where('name', 'Aula 1')->first()){
            Classe::create([
                'name' => "Aula 1",
                'description' => 'Lorem ipsum dolor sit amet, 
                consectetur adipiscing elit. Mauris consequat 
                lectus non efficitur rhoncus',
                'course_id' => 8,
            ]);
        }

        if(!Classe::where('name', 'Aula 2')->first()){
            Classe::create([
                'name' => "Aula 2",
                'description' => 'Lorem ipsum dolor sit amet, 
                consectetur adipiscing elit. Mauris consequat 
                lectus non efficitur rhoncus',
                'course_id' => 8,
            ]);
        }
    }
}
