<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class EsqueceuSenhaController extends Controller
{
    public function esqueceuSenhaForm(){
        return view('login.esqueceu-senha');
    }

    public function recuperarSenha(Request $request){
        $request->validate([
            'email'=>'required|email',
        ],[
            'email.required'=>'E-mail é obrigatório',
            'email.email'=>'E-mail inválido'
        ]);

        // verificar seo email tem cadastro no bd
        $usuario = User::where('email',$request->email)->first();

        if(!$usuario){
            Log::warning('Tentativa de recuperar senha com e-mail não cadastrado. ',['email'=>$request->email]);

            return back()->withInput()->with('error', 'E-mail não cadastrado');
        }

        try{
            // salvar o token recuperar senha e enviar e-mail
            $status = Password::sendResetLink(
                $request->only('email')
            );

            // salvar log
            Log::info('Recuperar senha', ['resposta'=>$status, 'email'=>$request->email]);

            return redirect()->route('login')->with('success','E-mail enviado, acesse sua caixa de e-mail para recuperar sua senha');

        }catch(Exception $e){
            Log::warning('Erro ao recuperar sena', ['error'=>$e->getMessage(), 'email'=>$request->email]);

            return back()->withInput()->with('error', 'E-mail não encontrado');
        }
    }

    public function showResetPassword(Request $request){
        
        return view('login.recuperarSenha',['token'=>$request->token]);
    }

    public function recuperarSenhaUpdate(Request $request){
        $request->validate([
            'token'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6|confirmed'
        ]);

        try{

            $status = Password::reset(
                $request->only('email','password', 'password_confirmation', 'token'),

                function(User $usuario, string $senha){
                    $usuario->forceFill([
                        'password'=>Hash::make($senha)
                    ]);

                    $usuario->save();
                }
  
            );

            Log::info('Senha Atualizado', ['resposta'=>$status, 'email'=>$request->email]);

            return $status===Password::PASSWORD_RESET ? redirect()->route('login')->with('success','Senha atualiada com sucesso') : back()->withInput()->with('error', __($status)); 

        }catch(Exception $e){
            Log::warning('Erro ao atualizar a senha',['error'=>$e->getMessage(), 'email'=>$request->email]);

            return back()->withInput()->with('error', 'Erro: Tente novamente mais tarde');
        }
    }
}
