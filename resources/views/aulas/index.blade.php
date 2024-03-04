@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements">
        <h2 class="mt-3">Dashboard</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item "><a href="#" class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('curso.index')}}" class="text-decoration-none">Cursos</a></li>
            <li class="breadcrumb-item "><a href="{{route('curso.show',['cursoId'=>$cursoId->id])}}" class="text-decoration-none">  Curso</a></li>
            <li class="breadcrumb-item active">Aulas</li>
        </ol>
    </div>

    <div class="card mb-4 border-light shadow">
        <div class="card-header space-between-elements">
            <span>Pesquisa</span>
        </div>
        <div class="card-body">
            <form action="{{ route('aula.index',['cursoId'=>$cursoId]) }}">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <label class="form-label" for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $name }}" placeholder="Nome da Aula">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label" for="dataInicio">Data de Cadastro Inicial</label>
                        <input type="datetime-local" name="dataInicio" id="dataInicio" class="form-control" value="{{$dataInicio}}" >
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label" for="dataFinal">Data de Cadastro Final</label>
                        <input type="datetime-local" name="dataFinal" id="dataFinal" class="form-control" value="{{$dataFinal}}">
                    </div>
                    <div class="col-md-4 col-sm-12 mt-4 pt-3" >
                        <button type="submit" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                        <a href="{{ route('aula.index',['cursoId'=>$cursoId]) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-trash-can"></i> Limpar </a>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header space-between-elements">
            <span>Listar</span>
            <span>
                <a href="{{route('curso.index')}}" class="btn btn-info"> <i class="fa-solid fa-list-ul"></i></i> Cursos</a>
                @can('create-aula')
                    <a href="{{route('aula.create',['cursoId'=>$cursoId->id])}}" class="btn btn-success"> <i class="fa-regular fa-square-plus"></i> Cadastrar aula</a>
                @endcan

            </span>
         </div>
         <div class="card-body">
            {{-- chamada de mensagem de erro ou sucesso --}}
            <x-alert/>

            {{-- inicio de tabelas de dados --}}
            <table  class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                      <th >ID</th>
                      <th >NOME</th>
                      <th class="d-none d-md-table-cell">ORDEM</th>
                      <th class="d-none d-md-table-cell">CURSO</th>
                      <th >AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aulas as $aula)
                        <tr>
                            <td>{{$aula->id}}</td>
                            <td>{{$aula->name}}</td>
                            <td class="d-none d-md-table-cell">{{$aula->ordem}}</td>
                            <td class="d-none d-md-table-cell">{{$aula->curso->name}}</td>
                            <td class="d-md-flex">
                                @can('show-aula')
                                    <a href="{{route('aula.show',['aulaId'=>$aula->id])}}" class="btn btn-info btn-sm me-1 mb-1"><i class="fa-solid fa-eye"></i>  Detalhes </a>
                                @endcan
                                @can('edit-aula')
                                    <a href="{{route('aula.edit',['aulaId'=>$aula->id])}}" class="btn btn-warning btn-sm me-1 mb-1"> <i class="fa-regular fa-pen-to-square"></i>  Editar </a>
                                @endcan
                                @can('destroy-aula')
                                    {{-- como o navegador não aceita o metodo delete o link de exlcusão precisa esta dentro de um fomuçario --}}
                                    <form method="POST" action="{{route('aula.destroy',['aulaId'=>$aula->id])}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm me-1 mb-1" onclick="return confirm('Tem certeza excluir?')"><i class="fa-solid fa-trash-can"></i> Excluir</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <div class="alert alert-danger" role="alert">
                            Nenhuma Aula Cadastrado
                        </div>
                    @endforelse
                </tbody>
            </table>
            {{-- paginação em laravel --}}
            {{$aulas->links()}}
        </div>
    </div>
</div>
@endsection
