<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissões para cada pagina
        $permisions = [
            ['title'=>'Listar Cursos', 'name'=> 'index-curso'],
            ['title'=>'Detalhes Curos', 'name'=> 'show-curso'],
            ['title'=>'Cadastrar Cursp', 'name'=> 'create-curso'],
            ['title'=>'Editar Cursp', 'name'=> 'edit-curso'],
            ['title'=>'Apagar Curso', 'name'=> 'destroy-curso'],

            ['title'=>'Listar Aulas', 'name'=> 'index-aula'],
            ['title'=>'Detalhes Aulas', 'name'=> 'show-aula'],
            ['title'=>'Editar Aula', 'name'=> 'edit-aula'],
            ['title'=>'Cadastrar Aula', 'name'=> 'create-aula'],
            ['title'=>'Apagar Aula', 'name'=> 'destroy-aula'],

            ['title'=>'Listar Usuários', 'name'=> 'index-usuario'],
            ['title'=>'Detalhes Usuário', 'name'=> 'show-usuario'],
            ['title'=>'Cadastrar Usuário', 'name'=> 'create-usuario'],
            ['title'=>'Editar Usuário', 'name'=> 'edit-usuario'],
            ['title'=>'Editar Senha', 'name'=> 'edit-usuario-senha'],
            ['title'=>'Apagar Usuário', 'name'=> 'destroy-usuario'],

            ['title'=>'Listar Tipos de Usuários', 'name'=> 'index-role'],
            ['title'=>'Cadastrar Tipos de Usuários', 'name'=>'create-role'],
            ['title'=>'Editar Tipo de Usuário','name'=>'edit-role'],
            ['title'=>'Detalhes do Tipo de Usuário', 'name'=>'show-role'],
            ['title'=>'Pagar Tipo de Usuário', 'name'=>'destroy-role'],

            ['title'=>'Listar permissões do Tipo de Usuário', 'name'=>'index-role-permissions'],
            ['title'=>'Editar permissão do Tipo do Uusuário', 'name'=>'edit-role-permission'],

            ['title'=>'Listar Permissões', 'name'=> 'index-permission'],
            ['title'=>'Detalhes Permissões', 'name'=> 'show-permission'],
            ['title'=>'Cadastrar Permissões', 'name'=> 'create-permission'],
            ['title'=>'Editar Permissão', 'name'=> 'edit-permission'],
            ['title'=>'Apagar Permissão', 'name'=> 'destroy-permission'],
        ];

        foreach($permisions as $permision){
            $existingPermission = Permission::where('name', $permision['name'])->first();

            if(!$existingPermission){
                Permission::create(['title'=>$permision['title'],'name'=>$permision['name'],'guard_name'=>'web']);
            }
        }
    }
}
