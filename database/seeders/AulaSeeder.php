<?php

namespace Database\Seeders;

use App\Models\Aula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Aula::where('name','Aula 1')->first()){
            Aula::create([
                'name'=>'Aula 1',
                'descricao'=>'Descrição da Aula 01',
                'ordem'=>1,
                'curso_id'=>1
            ]);
        }

        if(!Aula::where('name','Aula 2')->first()){
            Aula::create([
                'name'=>'Aula 2',
                'descricao'=>'Descrição da Aula 02',
                'ordem'=>1,
                'curso_id'=>2
            ]);
        }
    }
}
