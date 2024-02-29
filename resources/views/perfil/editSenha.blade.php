@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements">    
        <h2 class="mt-3">Editar Senha</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item "><a href="{{route('dashboard')}}"  class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('usuario.index')}}"  class="text-decoration-none"> Usuarios</a></li>
            <li class="breadcrumb-item active">Usuário</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header space-between-elements">
            <span>Editar</span>
            <span class="d-flex justify-content-center">
                
                <a href="{{route('usuario.show',['usuario'=>$usuario->id])}}" class="btn btn-primary btn-sm me-1"> <i class="fa-solid fa-eye"></i> Visualizar </a> 
                
             </span>
        </div>
        <div class="card-body">
            {{-- chamada de mensagem de erro ou sucesso --}}
            <x-alert/>
            
            <form action="{{route('update-perfil-senha')}}" method="post" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="Senha no mínimo 6 caracteres" value="{{old('senha')}}" class="form-control">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success ">Salvar</button>
                </div>
                
            </form>
        </div>
    </div>
</div>    
@endsection