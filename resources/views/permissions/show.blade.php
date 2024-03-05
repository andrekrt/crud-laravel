@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements bg-light p-1 rounded">
        <h2 class="mt-3">Curso</h2>
        <ol class="breadcrumb mb-3 mt-3">
            <li class="breadcrumb-item "><a href="#"  class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('permission-index')}}"  class="text-decoration-none">Permissões</a></li>
            <li class="breadcrumb-item active"  class="text-decoration-none">Permissão</li>
        </ol>
    </div>

    <div class="card mb-4">
        <div class="card-header space-between-elements">
           <span>Detalhes</span>
            <span class="d-flex justify-content-center">
                @can('index-permission')
                    <a href="{{route('permission-index')}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Permissões</a>
                @endcan

                @can('edit-permission')
                    <a href="{{route('permission-edit',['permission'=>$permission->id])}}" class="btn btn-warning btn-sm me-1"> <i class="fa-regular fa-pen-to-square"></i>Editar </a>
                @endcan

                @can('destroy-permission')
                {{-- como o navegador não aceita o metodo delete o link de exlcusão precisa esta dentro de um fomuçario --}}
                <form method="POST" id="edit{{$permission->id}}" action="{{route('permission-destroy',['permission'=>$permission->id])}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm me-1 btnDelete" data-delete-id="{{ $permission->id }}" ><i class="fa-solid fa-trash-can"></i> Excluir</button>
                </form>
                @endcan
           </span>
        </div>
        <div class="card-body">
            {{-- chamada de mensagem de erro ou sucesso --}}
            <x-alert/>
            <dl class="row">
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-9">{{$permission->id}}</dd>

                <dt class="col-sm-3">Título:</dt>
                <dd class="col-sm-9">{{$permission->title}}</dd>

                <dt class="col-sm-3">Nome:</dt>
                <dd class="col-sm-9">{{$permission->name}}</dd>

                <dt class="col-sm-3">Cadastrado:</dt>
                <dd class="col-sm-9">{{\Carbon\Carbon::parse($permission->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</dd>

                <dt class="col-sm-3">Editado:</dt>
                <dd class="col-sm-9">{{\Carbon\Carbon::parse($permission->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection
