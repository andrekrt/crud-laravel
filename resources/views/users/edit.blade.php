@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements">
        <h2 class="mt-3">Curso</h2>
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
                @can('index-usuario')
                    <a href="{{route('usuario.index')}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Listar Usuários </a>
                @endcan
                @can('show-usuario')
                <a href="{{route('usuario.show',['usuario'=>$usuario->id])}}" class="btn btn-primary btn-sm me-1"> <i class="fa-solid fa-eye"></i> Visualizar </a>
                @endcan
                @can('destroy-usuario')
                    {{-- como o navegador não aceita o metodo delete o link de exlcusão precisa esta dentro de um fomuçario --}}
                    <form method="POST" id="edit{{$usuario->id}}" action="{{route('usuario.destroy',['usuario'=>$usuario->id])}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm  me-1 btnDelete" data-delete-id="{{ $usuario->id }}"><i class="fa-solid fa-trash-can"></i> Excluir</button>
                    </form>
                @endcan

             </span>
        </div>
        <div class="card-body">
            {{-- chamada de mensagem de erro ou sucesso --}}
            <x-alert/>

            <form action="{{route('usuario.update',['usuario'=>$usuario->id])}}" method="post" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="name" class="form-label">Nome:</label>
                    <input type="text" name="name" id="name" value="{{old('name', $usuario->name)}}" class="form-control">
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="text" name="email" id="email" value="{{old('email', $usuario->email)}}" class="form-control">
                </div>
                <div class="col-12">
                    <label for="roles" class="form-label">Tipo de Usuário:</label>
                    <select name="role" id="role" class="form-select">
                        <option value="{{old('role', $usuario->role)}}">Selecione</option>
                        @forelse ($roles as $role)
                            @if ($role != "Super Admin")
                                <option value="{{ $role }}" {{ old('roles') == $role || $role== $roleUsuario ? 'selected' : '' }}>{{ $role }}</option>
                            @else
                                @if (Auth::user()->hasRole('Super Admin'))
                                    <option value="{{$role}}" {{ old('roles') == $role || $role== $roleUsuario ? 'selected' : '' }} >{{$role}}</option>
                                @endif
                            @endif
                        @empty

                        @endforelse

                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success ">Salvar</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
