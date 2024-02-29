<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Exception;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function logar(LoginRequest $request){
        $request->validated();

        // validar o usuario

        $autenticado = Auth::attempt(['email'=>$request->email, 'password'=>$request->senha]);
        if(!$autenticado){
            return back()->withInput()->with('error','E-mail ou senha inválido');
        }

        // obter os dados do usuario autenticado
        $usuario = Auth::user();
        $usuario = User::find($usuario->id);

        // verificar se a permisão é superadmim, se tiver tem acesso a tudo
        if($usuario->hasRole('Super Admin')){
            // usuario tem todas permissoes
            $permissao = Permission::pluck('name')->toArray();
        }else{
            // recuperar as permissoes do banco de dados
            $permissao = $usuario->getPermissionsViaRoles()->pluck('name')->toArray();
        }

        // atribuir permisões
        $usuario->syncPermissions($permissao);

        return redirect()->route('dashboard');
    }

    public function create(){
        return view('login.create');
    }

    public function store(LoginUserRequest $request){

        $request->validated();

        DB::beginTransaction();

        try{
            $usuario=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->senha
            ]);

            $usuario->assignRole("Aluno");

            // salvar log e informações
            Log::info('Usuário Cadastrado com sucesso.',[$usuario]);

            DB::commit();
            // redirecionar o usuario e uma mensagem de sucesso
            return redirect()->route('login', ['menu'=>'cursos','usuario'=>$usuario->id])->with('success','Cadastrado com Sucesso');
        }catch(Exception $e){
            // salvar log e informações
            Log::danger('Usuario Não Cadastrado.',['error'=>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error', "Usuário não cadastrado");
        }

    }

    public function sair(){
        Auth::logout();

        return redirect()->route('login')->with('success','Deslogado com sucesso');
    }
}
