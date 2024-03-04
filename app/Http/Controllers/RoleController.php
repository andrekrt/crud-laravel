<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:index-role',['only' =>['index']]);
        $this->middleware('permission:create-role',['only'=>['create']]);
        $this->middleware('permission:edit-role',['only'=>['edit']]);
        $this->middleware('permission:show-role',['only'=>['show']]);
        $this->middleware('permission:destroy-role',['only'=>['destroy']]);

    }

    // listas tipos
    public function index(Request $request){

        // recuperar registros do bd
        $roles = Role::
        when($request->has('name'), function($whenQuery) use ($request){
            $whenQuery->where('name', 'like', '%'.$request->name.'%');
        })
        ->when($request->filled('dataInicio'), function($whenQuery) use ($request){
            $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse($request->dataInicio)->format('Y-m-d H:i:s'));
        })
        ->when($request->filled('dataFinal'), function($whenQuery) use ($request){
            $whenQuery->where('created_at', '<=', \Carbon\Carbon::parse($request->dataFinal)->format('Y-m-d H:i:s'));
        })
        ->orderBy('id')->paginate(10)->withQueryString();

        // salvar log
        Log::info('Listar tipos de usuários', ['action_user_id'=>Auth::id()]);

        // carregar view
        return view('roles.index',[
            'menu'=>'roles',
            'roles'=>$roles,
            'name'=>$request->name,
            'dataInicio'=>$request->dataInicio,
            'dataFinal'=>$request->dataFinal
        ]);
    }

    // carregar form de cadastro
    public function create(){

        return view('roles.create',['menu'=>'role']);
    }

    // cadastra tipo de usuario no bd
    public function store(RoleRequest $request){

        // validação de formulario
        $request->validated();

        DB::beginTransaction();

        try{
            // cadastro no bd
            $role = Role::create([
                'name'=>$request->name,
                'guard_name'=>'web'
            ]);

            // salvar log e informações
            Log::info('Tipo de Usuário Cadastrado com sucesso.',[$role]);

            DB::commit();

            // redirecionar o usuario e uma mensagem de sucesso
            return redirect()->route('role-show', ['menu'=>'roles','roleId'=>$role->id])->with('success','Cadastrado com Sucesso');

        }catch(Exception $e){
            // salvar log e informações
            Log::info('Tipo de usuário Não Cadastrado.',['error'=>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error', "Tipo de usuário não cadastrado");
        }
    }

    public function show(Request $request){
        // trazer informações do registro
        $role = Role::where('id',$request->roleId)->first();

        return view('roles.show',['menu'=>'roles', 'role'=>$role]);
    }

    public function edit(Request $request){
        // pegar informações do curso para exibir no formulario de editar
        $role = Role::where('id',$request->roleId)->first();

        return view('roles.edit',['menu'=>'role','role'=>$role]);
    }

    // atualizar curso no bd
    public function update(RoleRequest $request, Role $roleId){

        $request->validated();

        DB::beginTransaction();

        try{
            $roleId->update(['name'=>$request->name]);

            // salvar log e informações
            Log::info('Tipo de Usuário Editado com sucesso.',['id'=>$roleId->id]);

            DB::commit();

            return redirect()->route('role-show',['menu'=>'cursos','roleId'=>$roleId->id])->with('success','Tipo de Usuário Editado com sucesso');
        }catch(Exception $e){
            // salvar log e informações
            Log::info('Tipo de Usuário Não Editado.',['error' =>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error','Tipo de Usuário Não Editado ');
        }

    }

    public function destroy(Role $roleId){
        // verificar se é super admin, pois super admin não pode ser excluido
        if($roleId->name=='Super Admin'){

            // salvar log
            Log::warning('Super Admin não pode ser excluído', ['papel_id'=>$roleId->id, 'action_user_id'=>Auth::id()]);

            return redirect()->route('role-index')->with('error', "Não é possível excluir o tipo de usuário Super Admin");
        }

        // verificar se existe usuario com esse tipo de usuario se tiver não deixar excluir
        if($roleId->users->isNotEmpty()){

            // salvar log
            Log::warning('Tipo de usuário não pode ser excluído porque existe usuários com esses tipo.',['papel_id'=>$roleId->id,'action_user_id'=>Auth::id()]);

            return redirect()->route('role-index')->with('error', 'Não é possível excluir esse tipo de usuário, pois existe usuários com esse tipo.');
        }

        DB::beginTransaction();

        try{
            // deletar do bd
            $roleId->delete();

            Log::info('Tipo de usuário excluído com sucesso.',['id'=>$roleId->id,'action_user_id'=>Auth::id()]);

            DB::commit();

            return redirect()->route('role-index')->with('success', 'Tipo de usuário excluído com sucesso.');
        }catch(Exception $e){

            Log::warning('Erro ao excluir Tipo de usuário .',['error'=>$e->getMessage(),'action_user_id'=>Auth::id()]);

            DB::rollBack();

            return back()->withInput()->with('error','Tipo de Usuário Não excluído ');

        }
    }
}
