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
                    <th >NOME</th>

                    <th >AÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <th>{{$permission->id}}</th>
                            <td>{{$permission->title}}</td>

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
            {{-- {{$permissions->links()}} --}}
        </div>
    </div>
</div>
@endsection
