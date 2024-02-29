<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // tipos de usuarios
        if (!Role::where('name', 'Super Admin')->first()) {
            Role::create(['name' => 'Super Admin']);
        }

        if (!Role::where('name', 'Admin')->first()) {
            $admin = Role::create(['name' => 'Admin']);

            // setando as areas permitdas para esse tipo de usuario
            $admin->givePermissionTo([
                'index-curso',
                'show-curso',
                'create-curso',
                'edit-curso',
                'destroy-curso',
                'index-aula',
                'show-aula',
                'edit-aula',
                'create-aula',
                'destroy-aula',
                'index-usuario',
                'show-usuario',
                'create-usuario',
                'edit-usuario',
                'edit-usuario-senha',
                'destroy-usuario',
                'index-role'
            ]);
        }

        if (!Role::where('name', 'Professor')->first()) {
            $professor = Role::create(['name' => 'Professor']);

            // setando as areas permitdas para esse tipo de usuario
            $professor->givePermissionTo([
                'index-curso',
                'show-curso',
                'create-curso',
                'edit-curso',
                'destroy-curso',
                'index-aula',
                'show-aula',
                'edit-aula',
                'create-aula',
                'destroy-aula'
            ]);
        }

        if (!Role::where('name', 'Tutor')->first()) {
            $tutor = Role::create(['name' => 'Tutor']);

            // setando as areas permitdas para esse tipo de usuario
            $tutor->givePermissionTo([
                'index-curso',
                'show-curso',
                'edit-curso',
                'index-aula',
                'show-aula',
                'edit-aula',
            ]);
        }

        if (!Role::where('name', 'Aluno')->first()) {
            $aluno = Role::create(['name' => 'Aluno']);
        }
    }
}
