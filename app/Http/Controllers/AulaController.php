<?php

namespace App\Http\Controllers;

use App\Http\Requests\AulaRequest;
use App\Models\Aula;
use App\Models\Curso;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AulaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');

        $this->middleware('permission:index-aula',['only'=>'index']);
        $this->middleware('permission:show-aula',['only'=>'show']);
        $this->middleware('permission:edit-aula',['only'=>'edit']);
        $this->middleware('permission:create-aula',['only'=>'create']);
        $this->middleware('permission:destroy-aula',['only'=>'destroy']);

    }

    // listar aulas
    public function index(Curso $cursoId){

        $aulas=Aula::with('curso')->where('curso_id', $cursoId->id)->orderBy('ordem')->paginate(10);

        return view('aulas.index',['menu'=>'cursos','aulas'=>$aulas, 'cursoId'=>$cursoId]);
    }

    // detalhes da aula
    public function show(Aula $aulaId){

        $aula = Aula::with('curso')->where('id',$aulaId->id)->first();

        return view('aulas.show',['menu'=>'cursos','aula'=>$aula]);
    }

    // formulario editar aula
    public function edit(Aula $aulaId){

        $aula = Aula::where('id', $aulaId->id)->first();

        return view('aulas.edit',['menu'=>'cursos','aula'=>$aula]);
    }

    // atualizar aula
    public function update(AulaRequest $request, Aula $aulaId){

        $request->validated();

        DB::beginTransaction();

        try{
            $aulaId->update([
                'name'=>$request->name,
                'descricao'=>$request->descricao
            ]);

            // salvar log e informações
            Log::info('Aula Editada com sucesso.',['id'=>$aulaId->id]);

            DB::commit();

            return redirect()->route('aula.index', ['menu'=>'cursos','cursoId'=>$aulaId->curso_id])->with('success', 'Aula Atualizada com Sucesso');
        }catch(Exception $e){

            // salvar log e informações
            Log::info('Aula Não Editada.',['error' =>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error','Aula Não Editada ');

        }


    }

    // formulario cadastrar aula
    public function create(Curso $cursoId){

        return view('aulas.create', ['menu'=>'cursos','cursoId'=>$cursoId]);
    }

    // cadastrar aula no bd
    public function store(AulaRequest $request){

        $request->validated();

        // marca o ponto inical de uma transação
        DB::beginTransaction();

        try{

            $maxOrdem = Aula::where('curso_id', $request->cursoId)->orderByDesc('ordem')->first();

            $aula = Aula::create([
                'name'=>$request->name,
                'descricao'=>$request->descricao,
                'ordem'=>$maxOrdem ? $maxOrdem->ordem+1:1,
                'curso_id'=>$request->cursoId
            ]);

            // salvar log e informações
            Log::info('Aula Cadastrada com sucesso.',[$aula]);

            // operação concluida com exito
            DB::commit();

            return redirect()->route('aula.index', ['menu'=>'cursos','cursoId'=>$request->cursoId])->with('success', 'Aula Cadastrada com Sucesso');

        }
        catch(Exception $e){
            // salvar log e informações
            Log::info('Aula Não Cadastrada.',['error'=>$e->getMessage()]);

            // falha em alguma operação e retornar tudo que foi feito
            DB::rollBack();
            return redirect()->back()->with('error', 'Aula não cadastrada');
        }


    }

    // excluir aula
    public function destroy(Aula $aulaId){

        $aulaId->delete();

        return redirect()->route('aula.index',['cursoId'=>$aulaId->curso_id])->with('success','Aula Excluída com sucesso');
    }

}
