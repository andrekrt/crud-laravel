<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:index-permission',['only' =>['index']]);
        $this->middleware('permission:create-permission',['only'=>['create']]);
        $this->middleware('permission:edit-permission',['only'=>['edit']]);
        $this->middleware('permission:show-permission',['only'=>['show']]);
        $this->middleware('permission:destroy-permission',['only'=>['destroy']]);
    }

    // listar permissões
    public function index(){

        // recuperar os registros
        $permissions = Permission::orderBy('id')->paginate(10);

        // salvar log
        Log::info('Listar Permissões', ['action_user_id'=>Auth::id()]);

        // carregar view
        return view('permissions.index',['menu'=>'permissions', 'permissions'=>$permissions]);
    }

    // detalhes da permissão
    public function show(Request $request){
        // trazer informações do registro
        $permission = Permission::where('id',$request->permission)->first();

        return view('permissions.show',['menu'=>'permissions', 'permission'=>$permission]);
    }

    // formulario de editar
    public function edit(Request $request){
        // pegar informações do curso para exibir no formulario de editar
        $permission = Permission::where('id',$request->permission)->first();

        return view('permissions.edit',['menu'=>'permissions','permission'=>$permission]);
    }

    // editar no bd
    public function update(PermissionRequest $request, Permission $permission){
        // validas campos
        $request->validated();

        DB::beginTransaction();

        try{
            $permission->update([
                'name'=>$request->name,
                'title'=>$request->title
            ]);

            // salvar log
            Log::info('Permissão editada com sucesso.', ['id'=>$permission->id]);

            DB::commit();

            return redirect()->route('permission-show', ['menu'=>'permissions','permission'=>$permission->id])->with('success','editado com Sucesso');
        }catch(Exception $e){
            // salvar log
            Log::warning('Permissão não editada.', ['error'=>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error','Permissão  não editado .');

        }

    }

    // formulario cadastrar
    public function create(){
        return view('permissions.create',['menu'=>'permissions']);
    }

    public function store(PermissionRequest $request){
        // validar campos
        $request->validated();

        DB::beginTransaction();

        try{

            // Cadastrar no banco de dados
            $permission = Permission::create([
                'title' => $request->title,
                'name' => $request->name,
            ]);

            // Salvar log
            Log::info('Permissão cadastrado com sucesso.', ['id' => $permission->id, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('permission-index')->with('success', 'Permissão cadastrada com sucesso!');
        }catch(Exception $e){

            // salvar log
            Log::warning('Permissão não cadastrada com sucesso.',['error'=>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error','Permissão não cadastrada.');

        }
    }

    // excluir permissao
    public function destroy(Permission $permission){

        DB::beginTransaction();

        try{
            // deletar do bd
            $permission->delete();

            // salvar log
            Log::info('Permissão excluída.', ['id'=>$permission->id, 'action_user_id'=>Auth::id()]);

            DB::commit();

            return redirect()->route('permission-index')->with('success','Permissão excluída com sucesso');

        }catch(Exception $e){

            // salvar log
            Log::info('Permissão não excluída.', ['error'=>$e->getMessage(), 'action_user_id'=>Auth::id()]);

            DB::rollBack();

            return back()->withInput()->with('error','Permissão não excluída.');

        }
    }
}
