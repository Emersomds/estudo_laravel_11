<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Course::where('name', 'Curso de Laravel - 10')->first()){
            Course::create([
                'name' => 'Curso de Laravel - 10',
                'price' => 197.46,
            ]);
        }

        if(!Course::where('name', 'Curso de Laravel - 11')->first()){
            Course::create([
                'name' => 'Curso de Laravel - 11',
                'price' => 225.46,
            ]);
        }

        if(!Course::where('name', 'Php 8.2')->first()){
            Course::create([
                'name' => 'Php 8.2',
                'price' => 154.46,
            ]);
        }

        if(!Course::where('name', 'Html')->first()){
            Course::create([
                'name' => 'Html',
                'price' => 97.46,
            ]);
        }    
    }
}
