@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements">
        <h2 class="mt-3">Permissão</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item "><a href="#"  class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('permission-index')}}"  class="text-decoration-none">Permissões</a></li>
            <li class="breadcrumb-item active">Permissão</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header space-between-elements">
            <span>Editar</span>
            <span class="d-flex justify-content-center">
                @can('index-permission')
                    <a href="{{route('permission-index')}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Listar Permissões </a>
                @endcan

                @can('show-permission')
                    <a href="{{route('permission-show',['permission'=>$permission->id])}}" class="btn btn-primary btn-sm me-1"> <i class="fa-solid fa-eye"></i> Visualizar </a>
                @endcan

             </span>
        </div>
        <div class="card-body">
            {{-- chamada de mensagem de erro ou sucesso --}}
            <x-alert/>

            <form action="{{route('permission-update',['permission'=>$permission->id])}}" method="post" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="title" class="form-label">Título:</label>
                    <input type="text" name="title" id="title" value="{{old('title', $permission->title)}}" class="form-control">
                </div>
                <div class="col-12">
                    <label for="curso" class="form-label">Nome:</label>
                    <input type="text" name="name" id="name" value="{{old('name', $permission->name)}}" class="form-control">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success ">Salvar</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
<div>
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
</div>
