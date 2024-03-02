<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Models\Curso;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CursoController extends Controller
{

    // coonstrutor
    public function __construct(){
        $this->middleware('auth');

        $this->middleware('permission:index-curso', ['only'=>['index']]);
        $this->middleware('permission:show-curso', ['only'=>['show']]);
        $this->middleware('permission:create-curso', ['only'=>['create']]);
        $this->middleware('permission:edit-curso', ['only'=>['edit']]);
        $this->middleware('permission:destroy-curso', ['only'=>['destroy']]);
    }

    // listar os cursos
    public function index(Request $request){
        //recuperar os cursos do bd
        $cursos = Curso::
        when($request->has('name'), function($whenQuery) use ($request){
            $whenQuery->where('name','like', '%'.$request->name. '%');
        })->
        orderByDesc('created_at')->paginate(10)->withQueryString();

        return view('cursos.index', [
            'menu'=>'cursos',
            'cursos'=>$cursos,
            'name'=>$request->name
        ]);
    }

    //detalhes curso
    public function show(Request $request){
        // recuperar todas as informações do registro

        $curso = Curso::where('id',$request->cursoId)->first();
        return view('cursos.show', ['menu'=>'cursos','curso'=>$curso]);
    }

    //formulario de criar curso
    public function create(){
        return view('cursos.create',['menu'=>'cursos']);
    }

    //add no curso no bd
    public function store(CursoRequest $request ){

        // validação de formualrio
        $request->validated();

        // cadastrar no banco de dados todos os registros recebidos
        // $curso = Curso::create($request->all());

        DB::beginTransaction();

        try{
            // cadastrar no banco campo por campo assim podemos formatar
            $curso = Curso::create([
                'name'=>$request->name,
                'price'=>str_replace(',','.',str_replace('.','',$request->price))
            ]);

            // salvar log e informações
            Log::info('Curso Cadastrado com sucesso.',[$curso]);

            DB::commit();

            // redirecionar o usuario e uma mensagem de sucesso
            return redirect()->route('curso.show', ['menu'=>'cursos','cursoId'=>$curso->id])->with('success','Cadastrado com Sucesso');
        }catch(Exception $e){
            // salvar log e informações
            Log::info('Curso Não Cadastrado.',['error'=>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error', "Curso não cadastrado");
        }


    }

    //formulario de editar curso
    public function edit(Request $request){

        // pegar informações do curso para exibir no formulario de editar
        $curso = Curso::where('id',$request->cursoId)->first();

        return view('cursos.edit',['menu'=>'cursos','curso'=>$curso]);
    }

    // atualizar curso no bd
    public function update(CursoRequest $request, Curso $cursoId){

        $request->validated();

        DB::beginTransaction();

        try{
            $cursoId->update(['name'=>$request->name, 'price'=>str_replace(',','.',str_replace('.','',$request->price))]);

            // salvar log e informações
            Log::info('Curso Editado com sucesso.',['id'=>$cursoId->id]);

            DB::commit();

            return redirect()->route('curso.show',['menu'=>'cursos','cursoId'=>$cursoId->id])->with('success','Curso Editado com sucesso');
        }catch(Exception $e){
            // salvar log e informações
            Log::info('Curso Não Editado.',['error' =>$e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error','Curso Não Editado ');
        }



    }

    //apagar cursos no bd
    public function destroy(Curso $cursoId){
        try{
            $cursoId->delete();

            return redirect()->route('curso.index')->with('success',"Curso excluído com sucesso");
        }catch(Exception $e){
            return redirect()->route('curso.index')->with('error',"Erro ao exlcuir curso");
        }

    }

}
