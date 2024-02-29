@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements">
        <h2 class="mt-3">Tipo de Usuário</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item "><a href="#"  class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('role-index')}}"  class="text-decoration-none">Tipos de Usuários</a></li>
            <li class="breadcrumb-item active">Tipo de Usuário</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header space-between-elements">
            <span>Editar</span>
            <span class="d-flex justify-content-center">
                @can('index-role')
                    <a href="{{route('role-index')}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Listar Tipos de Usuários </a>
                @endcan

                @can('show-role')
                    <a href="{{route('role-show',['roleId'=>$role->id])}}" class="btn btn-primary btn-sm me-1"> <i class="fa-solid fa-eye"></i> Visualizar </a>
                @endcan

             </span>
        </div>
        <div class="card-body">
            {{-- chamada de mensagem de erro ou sucesso --}}
            <x-alert/>

            <form action="{{route('role-update',['roleId'=>$role->id])}}" method="post" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="curso" class="form-label">Tipo de usuário:</label>
                    <input type="text" name="name" id="name" value="{{old('name', $role->name)}}" class="form-control">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success ">Salvar</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
