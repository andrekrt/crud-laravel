<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Curso::where('name', 'Curso de Design Gráfico')->first()){
            Curso::create([
                'name'=>"Curso de Design Gráfico",
                'price'=>'590.50'
            ]);
        }  

        if(!Curso::where('name', 'Curso de Laravel')->first()){
            Curso::create([
                'name'=>"Curso de Laravel",
                'price'=>'150.99'
            ]);
        }  
       
    }
}
