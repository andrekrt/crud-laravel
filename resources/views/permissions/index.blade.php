@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements ">
        <h2 class="mt-3 ">Dashboard</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item active"><a href="#"  class="text-decoration-none"></a> Dashboard</li>
            <li class="breadcrumb-item active">Permissões</li>
        </ol>
    </div>

    <div class="card mb-4 border-light shadow">
        <div class="card-header space-between-elements">
            <span>Pesquisa</span>
        </div>
        <div class="card-body">
            <form action=""{{ route('permission-index') }}>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label" for="title">Título</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $title }}" placeholder="Nome do Página">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label" for="name">Permissão</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $name }}" placeholder="Nome da Permissão">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label" for="dataInicio">Data de Cadastro Inicial</label>
                        <input type="datetime-local" name="dataInicio" id="dataInicio" class="form-control" value="{{ $dataInicio }}" >
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label" for="dataFinal">Data de Cadastro Final</label>
                        <input type="datetime-local" name="dataFinal" id="dataFinal" class="form-control" value="{{ $dataFinal }}">
                    </div>
                    <div class="col-md-4 col-sm-12 mt-4 pt-3" >
                        <button type="submit" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                        <a href="{{ route('permission-index') }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-trash-can"></i> Limpar </a>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header space-between-elements">
           <span>Listar</span>
           <span>
            @can('create-permission')
                <a href="{{route('permission-create')}}" class="btn btn-success"> <i class="fa-regular fa-square-plus"></i> Cadastrar Permissão</a>
            @endcan
            @can('index-permission')
                {{-- gerar pdf com filtro de pesquisa --}}
                <a target="_blank" href="{{ url('pdf-permission?'.request()->getQueryString()) }}" class="btn btn-success ms-2" > <i class="fa-regular fa-file-pdf"></i>  Gerar PDF </a>
            @endcan
           </span>
        </div>
        <div class="card-body">
           {{-- chamada de mensagem de erro ou sucesso --}}
           <x-alert/>

            {{-- inicio de tabelas de dados --}}
            <table class="table table-striped table-hover table-bordered ">
                <thead>
                  <tr>
                    <th >ID</th>
                    <th >Página</th>
                    <th  >Permissão</th>
                    <th >AÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <th>{{$permission->id}}</th>
                            <td>{{$permission->title}}</td>
                            <td>{{$permission->name}}</td>
                            <td class="d-md-flex">
                                @can('show-permission')
                                    <a href="{{route('permission-show',['permission'=>$permission->id])}}" class="btn btn-info btn-sm me-1 mb-1"><i class="fa-solid fa-eye"></i>  Detalhes</a>
                                @endcan

                                @can('edit-permission')
                                    <a href="{{route('permission-edit',['permission'=>$permission->id])}}" class="btn btn-warning btn-sm me-1 mb-1"> <i class="fa-regular fa-pen-to-square"></i> Editar </a>
                                @endcan

                                @can('destroy-permission')
                                {{-- como o navegador não aceita o metodo delete o link de exlcusão precisa esta dentro de um fomuçario --}}
                                <form method="POST" id="edit{{$permission->id}}" action="{{route('permission-destroy',['permission'=>$permission->id])}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1 me-1 btnDelete" data-delete-id="{{ $permission->id }}" ><i class="fa-solid fa-trash-can"></i> Excluir</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum Curso Cadastrado
                            </div>
                    @endforelse
                </tbody>
            </table>

            {{-- paginação em laravel --}}
            {{$permissions->links()}}
        </div>
    </div>
</div>
@endsection
