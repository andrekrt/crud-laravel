<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

class RolePermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:index-role-permissions',['only'=>['index']]);
        $this->middleware('permission:edit-role-permission',['only'=>['update']]);
    }

    // listas permissões do tipo de usuario
    public function index(ModelsRole $roleId, Request $request){

        // se o for supr admim, não visualizar as permissões
        if($roleId->name=='Super Admin'){

            Log::warning('Permissões do super admin não podem ser acessadas.',['action_user_id'=>Auth::id()]);

            // redirecionar o usuario, e enviar mensagem
            return redirect()->route('role-index')->with('error', 'Permissão do super admin não pode ser acessada');
        }

        // recuperar as permissões do tipo passado
        $permissionsRole = DB::table('role_has_permissions')->where('role_id',$roleId->id)->pluck('permission_id')->all();

        // recuperar todas as permissões
        $permissions = Permission::
        when($request->has('name'), function($whenQuery) use ($request){
            $whenQuery->where('name', 'like', '%' . $request->name. '%');
        })
        -> when($request->has('title'), function($whenQuery) use ($request){
            $whenQuery->where('title', 'like', '%' . $request->title. '%');
        })
        ->when($request->filled('dataInicio'), function($whenQuery) use ($request){
            $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse($request->dataInicio)->format('Y-m-d H:i:s'));
        })
        ->when($request->filled('dataFinal'), function($whenQuery) use ($request){
            $whenQuery->where('created_at', '<=', \Carbon\Carbon::parse($request->dataFinal)->format('Y-m-d H:i:s'));
        })
        ->paginate(10)->withQueryString();

        // salvar log
        Log::info('Listar permissões do tipo de usuário.', ['papel_id'=>$roleId->id,'action_user_id'=>Auth::id()]);

        // carregar view
        return view('rolesPermission.index',[
            'menu'=>'roles',
            'permissionsRole'=>$permissionsRole,
            'permissions'=>$permissions,
            'role'=>$roleId,
            'title'=>$request->title,
            'name'=>$request->name,
            'dataInicio'=>$request->dataInicio,
            'dataFinal'=>$request->dataFinal
        ]);

    }

    // editar permisão de aceso para pagina
    public function update(Request $request, ModelsRole $roleId){

        // obeter a permissão especifica com base no Id fornecedor no request
        $permission =  Permission::find($request->permissionId);

        // verificar se a permissao foi encontrada
        if(!$permission){
         return redirect()->route('role-permission-index',['roleId'=>$roleId->id])->with('error', 'Permissão não encontrada');
        }

        // verificar se a permissão ja esta associado ao tipo de usuario
        if($roleId->permissions->contains($permission)){
            // remover a permissao do tipo de usuario (bloquear)
            $roleId->revokePermissionTo($permission);

            // salvar log
            Log::info('Bloquear permissão para o tipo de usuário.',['action_user_id'=>Auth::id(),'permissao'=>$request->permission]);

            return redirect()->route('role-permission-index',['roleId'=>$roleId->id])->with('success',"Permissão bloqueada com sucesso");
        }else{
            // adicionar a permissão ao papel(liberar)
            $roleId->givePermissionTo($permission);

            // salvar log
            Log::info('Liberar permissão para o tipo de usuário.',['action_user_id'=>Auth::id(),'permissao'=>$request->permission]);

            return redirect()->route('role-permission-index',['roleId'=>$roleId->id])->with('success',"Permissão liberada com sucesso");
        }

    }
}
