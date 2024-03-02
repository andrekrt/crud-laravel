@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 space-between-elements ">
        <h2 class="mt-3 ">Usuários</h2>
        <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
            <li class="breadcrumb-item active"><a href="{{route('dashboard')}}"  class="text-decoration-none"></a> Dashboard</li>
            <li class="breadcrumb-item active">Usuarios</li>
        </ol>
    </div>

    <div class="card mb-4 border-light shadow">
        <div class="card-header space-between-elements">
            <span>Pesquisa</span>
        </div>
        <div class="card-body">
            <form action=""{{ route('usuario.index') }}>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label" for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $name }}" placeholder="Nome do Usuário">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label" for="email">E-mail</label>
                        <input type="text" name="email" id="email" class="form-control" value="" placeholder="E-mail do Usuário"  value="{{ $email }}">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label" for="dataInicio">Data de Cadastro Inicial</label>
                        <input type="datetime-local" name="dataInicio" id="dataInicio" class="form-control" value="{{ $dataInicio }}" >
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label" for="dataFinal">Data de Cadastro Final</label>
                        <input type="datetime-local" name="dataFinal" id="dataFinal" class="form-control" value="{{ $dataFinal }}">
                    </div>
                    <div class="col-md-4 col-sm-12 mt-4 pt-3" >
                        <button type="submit" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                        <a href="{{ route('usuario.index') }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-trash-can"></i> Limpar </a>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header space-between-elements">
           <span>Listar</span>
           <span>
            {{-- <a href="/" class="btn btn-info bnt-sm">Início</a> <br> --}}
            @can('create-usuario')
                <a href="{{route('usuario.create')}}" class="btn btn-success"> <i class="fa-regular fa-square-plus"></i> Cadastrar Usuário</a> <br><br>
            @endcan

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
                    <th class="d-none d-md-table-cell" >E-mail</th>
                    <th >AÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                        <tr>
                            <th>{{$usuario->id}}</th>
                            <td>{{$usuario->name}}</td>
                            <td class="d-none d-md-table-cell">{{$usuario->email }}</td>
                            <td class="d-md-flex justify-content-center">
                                @can('show-usuario')
                                    <a href="{{route('usuario.show',['usuario'=>$usuario->id])}}" class="btn btn-info btn-sm me-1 mb-1"><i class="fa-solid fa-eye"></i>  Detalhes</a>
                                @endcan
                                @can('edit-usuario')
                                    <a href="{{route('usuario.edit',['usuario'=>$usuario->id])}}" class="btn btn-warning btn-sm me-1 mb-1"> <i class="fa-regular fa-pen-to-square"></i> Editar </a>
                                @endcan
                                @can('destroy-usuario')
                                     {{-- como o navegador não aceita o metodo delete o link de exlcusão precisa esta dentro de um fomuçario --}}
                                    <form method="POST" action="{{route('usuario.destroy',['usuario'=>$usuario->id])}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm mb-1 me-1" onclick="return confirm('Tem certeza excluir?')"><i class="fa-solid fa-trash-can"></i> Excluir</button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum Usuário Cadastrado
                            </div>
                    @endforelse
                </tbody>
            </table>

            {{-- paginação em laravel --}}
            {{$usuarios->links()}}
        </div>
    </div>
</div>
@endsection
