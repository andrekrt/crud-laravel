@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements ">    
        <h2 class="mt-3">Curso</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item "><a href="#"  class="text-decoration-none"  class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('curso.index')}}"  class="text-decoration-none">Cursos</a></li>
            <li class="breadcrumb-item active">Curso</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header space-between-elements">
            <span>Cadastrar</span>
            @can('index-curso')
                <span class="d-flex justify-content-center">
                    <a href="{{route('curso.index')}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Listar Cursos </a> 
                </span>
            @endcan

        </div>
        <div class="card-body">
            {{-- chamada de mensagem de erro ou sucesso --}}
            <x-alert/>
            
            <form action="{{route('curso.store')}}" method="post" class="row g-3">
                @csrf 
                @method('POST')
                <div class="col-12">
                    <label for="name" class="form-label">Nome:</label>
                    <input type="text" name="name" id="name" placeholder="Nome do Curso" value="{{old('name')}}" class="form-control">
                </div>
                <div class="col-12">
                    <label for="price" class="form-label">Price:</label>
                    <input type="text" name="price" id="price" placeholder="Preço do Curso" value="{{old('price')}}" class="form-control">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success"> Cadastrar </button>
                </div>
                
            </form>
        </div>
    </div>
</div>   
@endsection