@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements ">
            <h2 class="mt-3">Usuário</h2>
            <ol class="breadcrumb mb-3 mt-3 bg-light p-1 rounded">
                <li class="breadcrumb-item "><a href="{{ route('dashboard') }}" class="text-decoration-none"
                        class="text-decoration-none"> Dashboard</a></li>
                <li class="breadcrumb-item "><a href="{{ route('usuario.index') }}" class="text-decoration-none">Usuários</a>
                </li>
                <li class="breadcrumb-item active">Usuário</li>
            </ol>
        </div>
        <div class="card mb-4">
            <div class="card-header space-between-elements">
                <span>Cadastrar</span>
                <span class="d-flex justify-content-center">
                    @can('index-usuario')
                        <a href="{{ route('usuario.index') }}" class="btn btn-info btn-sm me-1"><i
                                class="fa-solid fa-list-ul"></i> Listar Usuários </a>
                    @endcan

                </span>
            </div>
            <div class="card-body">
                {{-- chamada de mensagem de erro ou sucesso --}}
                <x-alert />

                <form action="{{ route('usuario.store') }}" method="post" class="row g-3">
                    @csrf
                    @method('POST')
                    <div class="col-12">
                        <label for="name" class="form-label">Nome:</label>
                        <input type="text" name="name" id="name" placeholder="Nome do Usuário"
                            value="{{ old('name') }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="text" name="email" id="email" placeholder="E-mail do Usuário"
                            value="{{ old('email') }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="roles" class="form-label ">Tipo de Usuário:</label>
                        <select name="roles" id="roles" class="form-select select2">
                            <option value="">Selecione</option>
                            @forelse ($roles as $role)
                                @if ($role != "Super Admin")
                                    <option value="{{ $role }}" {{ old('roles') == $role ? 'selected' : '' }}>{{ $role }}</option>
                                @else
                                    @if (Auth::user()->hasRole('Super Admin'))
                                        <option value="{{$role}}" {{ old('roles') == $role ? 'selected' : '' }} >{{$role}}</option>
                                    @endif
                                @endif
                            @empty

                            @endforelse

                        </select>
                    </div>
                    <div class="col-12">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha no mínimo 6 caracteres"
                            value="{{ old('senha') }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success"> Cadastrar </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
