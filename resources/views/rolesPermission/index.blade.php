@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements ">
        <h2 class="mt-3 ">Permissões do Tipo - {{$role->name}}</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item "><a href="#" class="text-decoration-none"> Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('role-index')}}" class="text-decoration-none">Tipos de Usuários</a></li>
            <li class="breadcrumb-item active">Permissões</li>
        </ol>
    </div>

    <div class="card mb-4 border-light shadow">
        <div class="card-header space-between-elements">
            <span>Pesquisa</span>
        </div>
        <div class="card-body">
            <form action=""{{ route('role-permission-index',['roleId'=>$role->id]) }}>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $title }}" placeholder="Nome do Página">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label" for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $name }}" placeholder="Nome da Permissão">
                    </div>
                    <div class="col-md-4 col-sm-12 mt-4 pt-3" >
                        <button type="submit" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                        <a href="{{ route('role-permission-index',['roleId'=>$role->id]) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-trash-can"></i> Limpar </a>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header space-between-elements">
           <span>Listar</span>
           <span>
            @can('index-role')
                <a href="{{route('role-create')}}" class="btn btn-success"> <i class="fa-regular fa-square-plus"></i> Cadastrar Tipo de Usuário</a>
            @endcan
            <br><br>
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
                    <th>TITLE</th>
                    <th >NOME</th>
                    <th >AÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <th>{{$permission->id}}</th>
                            <td>{{$permission->title}}</td>
                            <td>{{ $permission->name }}</td>
                            <td class="">
                                @if (in_array($permission->id,$permissionsRole ?? []))
                                    <a href="{{route('role-permission-update',['roleId'=>$role->id, 'permissionId'=>$permission->id])}}"> <span class="badge text-bg-success">LIBERADO</span> </a>
                                @else
                                    <a href="{{route('role-permission-update',['roleId'=>$role->id, 'permissionId'=>$permission->id]) }}"> <span class="badge text-bg-danger">BLOQUEADO</span></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum Permissão encontradas
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
