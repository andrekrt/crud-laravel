@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements">    
        <h2 class="mt-3">Curso</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item "><a href="#"  class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('curso.index')}}"  class="text-decoration-none">Cursos</a></li>
            <li class="breadcrumb-item active">Curso</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header space-between-elements">
            <span>Editar</span>
            <span class="d-flex justify-content-center">
                @can('index-curso')
                    <a href="{{route('curso.index')}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Listar Cursos </a>  
                @endcan
                
                @can('show-curso')
                    <a href="{{route('curso.show',['cursoId'=>$curso->id])}}" class="btn btn-primary btn-sm me-1"> <i class="fa-solid fa-eye"></i> Visualizar </a>  
                @endcan
                
                @can('destroy-curso')
                    {{-- como o navegador não aceita o metodo delete o link de exlcusão precisa esta dentro de um fomuçario --}}
                    <form method="POST" action="{{route('curso.destroy',['cursoId'=>$curso->id])}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza excluir?')"><i class="fa-solid fa-trash-can"></i> Excluir</button>
                    </form>
                @endcan
                
             </span>
        </div>
        <div class="card-body">
            {{-- chamada de mensagem de erro ou sucesso --}}
            <x-alert/>
            
            <form action="{{route('curso.update',['cursoId'=>$curso->id])}}" method="post" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="curso" class="form-label">Curso:</label>
                    <input type="text" name="name" id="name" value="{{old('name', $curso->name)}}" class="form-control">
                </div>
                <div class="col-12">
                    <label for="price" class="form-label">Price:</label>
                    <input type="text" name="price" id="price" value="{{old('price', $curso->price)}}" class="form-control">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success ">Salvar</button>
                </div>
                
            </form>
        </div>
    </div>
</div>    
@endsection