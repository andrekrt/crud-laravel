<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email','andre@andre.com')->first()){
            $superAdmin = User::create([
                'name'=>'André Santos',
                'email'=>'andre@andre.com',
                'password'=>Hash::make('andre123',['rounds'=>10])
            ]);
            // atribuir o tipo de usuario ao usuario criado a cima e consequentimento recebera os acesso que esse tipo de usuario tem
            $superAdmin->assignRole('Super Admin');
        }

        if(!User::where('email','laravel@laravel.com')->first()){
            $admin= User::create([
                'name'=>'Laravel',
                'email'=>'laravel@laravel.com',
                'password'=>Hash::make('laravel123',['rounds'=>10])
            ]);

            // atribuir o tipo de usuario ao usuario criado a cima e consequentimento recebera os acesso que esse tipo de usuario tem
            $admin->assignRole('Admin');
        }

        if(!User::where('email','professor@laravel.com')->first()){
            $professor= User::create([
                'name'=>'Professor',
                'email'=>'professor@laravel.com',
                'password'=>Hash::make('andre123',['rounds'=>10])
            ]);

            // atribuir o tipo de usuario ao usuario criado a cima e consequentimento recebera os acesso que esse tipo de usuario tem
            $professor->assignRole('Professor');
        }

        if(!User::where('email','tutor@laravel.com')->first()){
            $tutor= User::create([
                'name'=>'Tutor',
                'email'=>'tutor@laravel.com',
                'password'=>Hash::make('andre123',['rounds'=>10])
            ]);

            // atribuir o tipo de usuario ao usuario criado a cima e consequentimento recebera os acesso que esse tipo de usuario tem
            $tutor->assignRole('Tutor');
        }

        if(!User::where('email','aluno@laravel.com')->first()){
            $aluno= User::create([
                'name'=>'Aluno',
                'email'=>'aluno@laravel.com',
                'password'=>Hash::make('andre123',['rounds'=>10])
            ]);

            // atribuir o tipo de usuario ao usuario criado a cima e consequentimento recebera os acesso que esse tipo de usuario tem
            $aluno->assignRole('Aluno');
        }
    }
}
