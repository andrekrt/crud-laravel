@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements ">
        <h2 class="mt-3">Dashboard</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item "><a href="#" class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('curso.index')}}" class="text-decoration-none">Cursos</a></li>
            <li class="breadcrumb-item "><a href="{{route('curso.show',['cursoId'=>$aula->curso_id])}}" class="text-decoration-none">  Curso</a></li>
            <li class="breadcrumb-item "><a href="{{route('aula.index',['cursoId'=>$aula->curso_id])}}" class="text-decoration-none">Aulas</a></li>
            <li class="breadcrumb-item active">Aula</li>
        </ol>
    </div>

    <div class="card mb-4">
        <div class="card-header space-between-elements">
            <span>Detalhes</span>
            <span class="d-flex justify-content-center">
                @can('index-aula')
                    <a href="{{route('aula.index',['cursoId'=>$aula->curso_id])}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Aulas</a>
                @endcan
                @can('index-curso')
                    <a href="{{route('curso.index')}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Listar Cursos </a>
                @endcan
                @can('edit-aula')
                    <a href="{{route('aula.edit',['aulaId'=>$aula->id])}}" class="btn btn-warning btn-sm me-1"> <i class="fa-regular fa-pen-to-square"></i>Editar </a>
                @endcan
                @can('destroy-aula')
                    {{-- como o navegador não aceita o metodo delete o link de exclusao precisa esta dentro de um fomulario --}}
                    <form method="POST" action="{{route('aula.destroy',['aulaId'=>$aula->id])}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza excluir?')"><i class="fa-solid fa-trash-can"></i>Excluir</button>
                    </form>
                @endcan

            </span>
        </div>
        <div class="card-body">
            {{-- chamada de mensagem de erro ou sucesso --}}
            <x-alert/>

            <dl class="row">
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-9">{{$aula->id}}</dd>

                <dt class="col-sm-3">Aula:</dt>
                <dd class="col-sm-9">{{$aula->name}}</dd>

                <dt class="col-sm-3">Descrição:</dt>
                <dd class="col-sm-9">{{$aula->descricao}}</dd>

                <dt class="col-sm-3">Ordem:</dt>
                <dd class="col-sm-9">{{$aula->ordem}}</dd>

                <dt class="col-sm-3">Curso:</dt>
                <dd class="col-sm-9">{{$aula->curso->name}}</dd>

                <dt class="col-sm-3">Cadastrado em:</dt>
                <dd class="col-sm-9">{{\Carbon\Carbon::parse($aula->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</dd>

                <dt class="col-sm-3">Atualizado em:</dt>
                <dd class="col-sm-9">{{\Carbon\Carbon::parse($aula->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection
