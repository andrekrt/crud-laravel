@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements ">
        <h2 class="mt-3">Usuário</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item "><a href="{{route('dashboard')}}"  class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('usuario.index')}}"  class="text-decoration-none"> Usuarios</a></li>
            <li class="breadcrumb-item active"  class="text-decoration-none">Usuario</li>
        </ol>
    </div>

    <div class="card mb-4">
        <div class="card-header space-between-elements">
           <span>Detalhes</span>
            <span class="d-flex justify-content-center">
                @can('index-usuario')
                    <a href="{{route('usuario.index')}}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list-ul"></i> Listar Usuários </a>
                @endcan
                @can('edit-usuario')
                    <a href="{{route('usuario.edit',['usuario'=>$usuario->id])}}" class="btn btn-warning btn-sm me-1"> <i class="fa-regular fa-pen-to-square"></i>Editar </a>
                @endcan
                @can('edit-usuario-senha')
                    <a href="{{route('usuario.edit-senha',['usuario'=>$usuario->id])}}" class="btn btn-warning btn-sm me-1"> <i class="fa-regular fa-pen-to-square"></i>Editar Senha </a>
                @endcan
                @can('destroy-usuarioa')
                    {{-- como o navegador não aceita o metodo delete o link de exlcusão precisa esta dentro de um fomuçario --}}
                    <form method="POST" action="{{route('usuario.destroy',['usuario'=>$usuario->id])}}">
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
            <dl class="row">
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-9">{{$usuario->id}}</dd>

                <dt class="col-sm-3">Nome:</dt>
                <dd class="col-sm-9">{{$usuario->name}}</dd>

                <dt class="col-sm-3">E-mail:</dt>
                <dd class="col-sm-9">{{$usuario->email }}</dd>

                <dt class="col-sm-3">Tipo de Usuário:</dt>

                <dd class="col-sm-9">

                    @foreach ($usuario->getRoleNames() as $tipo)
                        {{$tipo}}
                    @endforeach

                </dd>

                <dt class="col-sm-3">Cadastrado:</dt>
                <dd class="col-sm-9">{{\Carbon\Carbon::parse($usuario->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</dd>

                <dt class="col-sm-3">Editado:</dt>
                <dd class="col-sm-9">{{\Carbon\Carbon::parse($usuario->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection
