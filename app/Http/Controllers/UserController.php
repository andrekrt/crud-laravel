<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');

        $this->middleware('permission:index-usuario',['only'=>'index']);
        $this->middleware('permission:show-usuario',['only'=>'show']);
        $this->middleware('permission:edit-usuario',['only'=>'edit']);
        $this->middleware('permission:create-usuario',['only'=>'create']);
        $this->middleware('permission:edit-usuario-senha',['only'=>'editSenha']);
        $this->middleware('permission:destroy-usuario',['only'=>'destroy']);
        $this->middleware('permission:pdf-usuario', ['only'=>'gerarPdf']);
    }

    public function index(Request $request){

        $usuarios = User::when($request->has('name'), function($whenQuery) use ($request){
            $whenQuery->where('name','like', '%'. $request->name. '%');
        })
        ->when($request->has('email'), function($whenQuery) use ($request){
            $whenQuery->where('email','like', '%'. $request->email. '%');
        })
        ->when($request->filled('dataInicio'), function($whenQuery) use ($request){
            $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse($request->dataInicio)->format('Y-m-d H:i:s'));
        })
        ->when($request->filled('dataFinal'), function($whenQuery) use ($request){
            $whenQuery->where('created_at', '<=', \Carbon\Carbon::parse($request->dataFinal)->format('Y-m-d H:i:s'));
        })
        ->orderBy('id')->paginate(10)->withQueryString();
        return view('users.index',[
            'menu'=>'users',
            'usuarios'=>$usuarios,
            'name'=>$request->name,
            'email'=>$request->email,
            'dataInicio'=>$request->dataInicio,
            'dataFinal'=>$request->dataFinal
        ]);

    }

    public function show(User $usuario){
        return view('users.show',['menu'=>'users', 'usuario'=>$usuario]);
    }

    public function create(){
        // recuperar os tipos de usuarios para mostrar no cadastro
        $roles = Role::pluck('name')->all();

        return view('users.create', [
            'menu'=>'users',
            'roles'=>$roles
        ]);
    }

    public function store(UserRequest $request){
        // validação de formualrio
        $request->validated();

        DB::beginTransaction();

        try{
            $usuario=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->senha,['rounds'=>10])
            ]);

            // cadastrar tipo no usuario
            $usuario->assignRole($request->roles);

            // salvar log e informações
            Log::info('Usuário Cadastrado com sucesso.',[$usuario]);

            DB::commit();
            // redirecionar o usuario e uma mensagem de sucesso
            return redirect()->route('usuario.show', ['menu'=>'cursos','usuario'=>$usuario->id])->with('success','Cadastrado com Sucesso');

        }catch(Exception $e){
            // salvar log e informações
            Log::danger('Usuario Não Cadastrado.',['error'=>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error', "Usuário não cadastrado");
        }

    }

    public function edit(User $usuario){

        // recuperar os tipos de usuarios para mostrar no cadastro
        $roles = Role::pluck('name')->all();

        // recuperar tipo do usuarios que vai ser editado
        $rolesUsuario = $usuario->roles->pluck('name')->first();

        return view('users.edit',[
            'menu'=>'users',
            'usuario'=>$usuario,
            'roleUsuario'=>$rolesUsuario,
            'roles'=>$roles
        ]);
    }

    public function update(UserRequest $request, User $usuario){

        $validated = $request->validated();

        DB::beginTransaction();

        try{
            $usuario->update([
                'name'=>$request->name,
                'email'=>$request->email
            ]);

            // editar o tipo de usuario
            $usuario->syncRoles($request->role);

            Log::info("Usuário Editado com Sucesso.",['id'=>$usuario->id]);

            DB::commit();

            return redirect()->route('usuario.show',['menu'=>'users','usuario'=>$usuario->id])->with('success','Curso Editado com Sucesso');
        }catch(Exception $e){
            Log::danger('Usuário não editado', ['error'=>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error','Curso não editado');
        }
    }

    public function editSenha(User $usuario){

        return view('users.editSenha',['menu'=>'users','usuario'=>$usuario]);
    }

    public function updateSenha(Request $request, User $usuario){
        // // validar formulario
        $request->validate([
            'senha'=>'required|min:6'
        ],[
            'senha.required'=>'O campo senha é obrigatório',
            'senha'.'min'=>'A senha ter no mínimo :min caracteres'
        ]);

        DB::beginTransaction();

        try{
            $usuario->update(
                ['password'=>$request->senha]
            );

            Log::info("Senha Editada com Sucesso.",['id'=>$usuario->id]);

            DB::commit();

            return redirect()->route('usuario.show',['menu'=>'users','usuario'=>$usuario->id])->with('success','Senha Editada com Sucesso');
        }catch(Exception $e){
            Log::danger('Senha não editada', ['error'=>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error','Senha não editada');
        }
    }

    public function destroy(User $usuario){
        try{
            $usuario->delete();

            // remover todos os tipos atribuidos ao usuario
            $usuario->syncRoles([

            ]);

            Log::info("Usuário excluído.",['id'=>$usuario->id, 'action_user_id'=>Auth::id()]);

            return redirect()->route('usuario.index')->with('success',"Usuário excluído com sucesso");
        }catch(Exception $e){
            return redirect()->route('usuario.index')->with('error',"Erro ao exlcuir usuário");
        }
    }

    public function gerarPdf(Request $request){
        // recuperar todos usuários cadastrados
        // $usuarios = User::orderBy('id')->get();

        // recuperar usuarios pesquisados
        $usuarios = User::when($request->has('name'), function($whenQuery) use ($request){
            $whenQuery->where('name','like', '%'. $request->name. '%');
        })
        ->when($request->has('email'), function($whenQuery) use ($request){
            $whenQuery->where('email','like', '%'. $request->email. '%');
        })
        ->when($request->filled('dataInicio'), function($whenQuery) use ($request){
            $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse($request->dataInicio)->format('Y-m-d H:i:s'));
        })
        ->when($request->filled('dataFinal'), function($whenQuery) use ($request){
            $whenQuery->where('created_at', '<=', \Carbon\Carbon::parse($request->dataFinal)->format('Y-m-d H:i:s'));
        })
        ->orderBy('id')->get();

        // total de registros
        $totalUsuarios = $usuarios->count('id');

        // verificar se a qtd ultrapassou o limite definido
        if($totalUsuarios>500 ){
            // redirecionar e enviar mensagem
            return redirect()->route('usuario.index',[
                'name'=>$request->name,
                'email'=>$request->email,
                'dataInicio'=>$request->dataInicio,
                'dataFinal'=>$request->dataFinal
            ])->with('error', 'Quantidade de registros que podem ser gerados, ultrapassado');
        }

        // carregar a string com o HTML do conteudo e determinar a orientação e tamanhho da pagina
        $pdf = PDF::loadView('users.pdf', ['usuarios'=>$usuarios])->setPaper('A4', 'portrait');

        // fazer o download do arquivo
        return $pdf->stream("Usuários.pdf");
    }
}
