@extends('layouts.admin')
@section('content')
<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements">
        <h2 class="mt-3">Dashboard</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item "><a href="#" class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('curso.index')}}" class="text-decoration-none">Cursos</a></li>
            <li class="breadcrumb-item "><a href="{{route('curso.show',['cursoId'=>$aula->curso_id])}}" class="text-decoration-none">  Curso</a></li>
            <li class="breadcrumb-item active" class="text-decoration-none" >Aulas</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header space-between-elements">
            <span>Editar</span>
            <span class="d-flex justify-content-center">
                @can('index-aula')
                    <a href="{{route('aula.index',['cursoId'=>$aula->curso_id])}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Listar Aulas </a>
                @endcan
                @can('show-aula')
                    <a href="{{route('aula.show',['aulaId'=>$aula->id])}}" class="btn btn-primary btn-sm me-1"> <i class="fa-solid fa-eye"></i> Visualizar </a>
                @endcan
                @can('destrou-aula')
                    {{-- como o navegador não aceita o metodo delete o link de exlcusão precisa esta dentro de um fomuçario --}}
                    <form method="POST" id="edit{{$aula->id}}" action="{{route('aula.destroy',['aulaId'=>$aula->id])}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1 btnDelete" data-delete-id="{{ $aula->id }}"><i class="fa-solid fa-trash-can"></i> Excluir</button>
                    </form>
                @endcan

             </span>
        </div>
        <div class="card-body">
            {{-- chamada de mensagem de erro ou sucesso --}}
            <x-alert/>

            <form action="{{route('aula.update',['aulaId'=>$aula->id])}}" method="post" class="row g-3">
                @csrf
                @method('PUT')
                <input type="hidden" name="aulaId" id="aulaId" value="{{$aula->id}}">
                <input type="hidden" name="cursoId" id="cursoId" value="{{($aula->curso_id)}}">
                <div class="col-12">
                    <label for="name" class="form-label">Nome:</label>
                    <input type="text" name="name" id="name" placeholder="Nome da Aula" value="{{($aula->name)}}" class="form-control">
                </div>
                <div class="col-12">
                    <label for="price" class="form-label">Descrição:</label>
                    <textarea name="descricao" id="descricao" class="form-control">{{($aula->descricao)}}</textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success"> Salvar </button>
                </div>


            </form>
        </div>
    </div>
</div>



@endsection
