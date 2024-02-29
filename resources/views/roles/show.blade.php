@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements bg-light p-1 rounded">
        <h2 class="mt-3">Curso</h2>
        <ol class="breadcrumb mb-3 mt-3">
            <li class="breadcrumb-item "><a href="#"  class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('role-index')}}"  class="text-decoration-none">Tipos de Usuário</a></li>
            <li class="breadcrumb-item active"  class="text-decoration-none">Tipo de Usuário</li>
        </ol>
    </div>

    <div class="card mb-4">
        <div class="card-header space-between-elements">
           <span>Detalhes</span>
            <span class="d-flex justify-content-center">
                @can('index-role-permissions')
                    <a href="{{route('role-index',['roleId'=>$role->id])}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Permissões</a>
                @endcan

                @can('index-role')
                    <a href="{{route('role-index')}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Listar Tipos de Usuários </a>
                @endcan

                @can('edit-role')
                    <a href="{{route('role-edit',['roleId'=>$role->id])}}" class="btn btn-warning btn-sm me-1"> <i class="fa-regular fa-pen-to-square"></i>Editar </a>
                @endcan
           </span>
        </div>
        <div class="card-body">
            {{-- chamada de mensagem de erro ou sucesso --}}
            <x-alert/>
            <dl class="row">
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-9">{{$role->id}}</dd>

                <dt class="col-sm-3">Nome:</dt>
                <dd class="col-sm-9">{{$role->name}}</dd>

                <dt class="col-sm-3">Cadastrado:</dt>
                <dd class="col-sm-9">{{\Carbon\Carbon::parse($role->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</dd>

                <dt class="col-sm-3">Editado:</dt>
                <dd class="col-sm-9">{{\Carbon\Carbon::parse($role->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection