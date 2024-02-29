<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerfilRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PerfilController extends Controller
{
    public function show(){
        $usuario = User::where('id', Auth::id())->first();

        return view('perfil.show',['usuario'=>$usuario]);
    }

    public function edit(){
        $usuario = User::where('id', Auth::id())->first();

        return view('perfil.edit',['usuario'=>$usuario]);
    }

    public function update(PerfilRequest $request){
        $validated = $request->validated(); 

        DB::beginTransaction();

        try{
            $usuario = User::where('id', Auth::id())->first();

            $usuario->update([
                'name'=>$request->name,
                'email'=>$request->email
            ]);

            Log::info("Usuário Editado com Sucesso.",['id'=>$usuario->id]);

            DB::commit();

            return redirect()->route('perfil-show')->with('success','Curso Editado com Sucesso');
        }catch(Exception $e){
            Log::warning('Usuário não editado', ['error'=>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error','Curso não editado');
        }
    }

    public function editSenha(){
        $usuario = User::where('id', Auth::id())->first();

        return view('perfil.editSenha',['usuario'=>$usuario]);
    }

    public function updateSenha(Request $request){
         // // validar formulario
         $request->validate([
            'senha'=>'required|min:6'
        ],[
            'senha.required'=>'O campo senha é obrigatório',
            'senha'.'min'=>'A senha ter no mínimo :min caracteres'
        ]);

        DB::beginTransaction();

        try{
            $usuario = User::where('id', Auth::id())->first();

            $usuario->update(
                ['password'=>$request->senha]
            );

            Log::info("Senha Editada com Sucesso.",['id'=>$usuario->id]);

            DB::commit();

            return redirect()->route('perfil-show')->with('success','Senha Editada com Sucesso');
        }catch(Exception $e){
            Log::warning('Senha não editada', ['error'=>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error','Senha não editada');
        }
    }
}
