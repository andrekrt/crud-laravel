@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements ">
        <h2 class="mt-3 ">Dashboard</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item active"><a href="#"  class="text-decoration-none"></a> Dashboard</li>
            <li class="breadcrumb-item active">Permissões</li>
        </ol>
    </div>

    <div class="card mb-4">
        <div class="card-header space-between-elements">
           <span>Listar</span>
           <span>
            @can('create-curso')
                <a href="{{route('permission-create')}}" class="btn btn-success"> <i class="fa-regular fa-square-plus"></i> Cadastrar Permissão</a>
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
                    <th >Página</th>
                    <th  >Permissão</th>
                    <th >AÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <th>{{$permission->id}}</th>
                            <td>{{$permission->title}}</td>
                            <td>{{$permission->name}}</td>
                            <td class="d-md-flex">
                                @can('show-curso')
                                    <a href="{{route('permission-show',['permission'=>$permission->id])}}" class="btn btn-info btn-sm me-1 mb-1"><i class="fa-solid fa-eye"></i>  Detalhes</a>
                                @endcan

                                @can('edit-curso')
                                    <a href="{{route('permission-edit',['permission'=>$permission->id])}}" class="btn btn-warning btn-sm me-1 mb-1"> <i class="fa-regular fa-pen-to-square"></i> Editar </a>
                                @endcan


                                    <a href="{{route('permission-index',['permission'=>$permission->id])}}" class="btn btn-secondary btn-sm me-1 mb-1"><i class="fa-solid fa-list"></i> Visualizar Aulas</a>

                                @can('destroy-curso')
                                {{-- como o navegador não aceita o metodo delete o link de exlcusão precisa esta dentro de um fomuçario --}}
                                <form method="POST" action="{{route('permission-destroy',['permission'=>$permission->id])}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1 me-1" onclick="return confirm('Tem certeza excluir?')"><i class="fa-solid fa-trash-can"></i> Excluir</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum Curso Cadastrado
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
