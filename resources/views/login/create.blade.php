@extends('layouts.login')

@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Cadastrar Usuário</h3></div>
                                <div class="card-body">
                                    <x-alert/>
                                    <form method="post" action="{{route('login.store')}}">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="name" id="name" type="text" placeholder="Nome do Ususário" value="{{old('name')}}" />
                                            <label for="nome">Nome</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="email" type="email" placeholder="E-mail do usuário" value="{{old('email')}}" />
                                            <label for="email">E-mail</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="senha" id="senha" type="password" placeholder="Senha de minímo 6 digitos" value="{{old('senha')}}"/>
                                            <label for="senha">Senha</label>
                                        </div>
                                    
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"> <button type="submit"  class="btn btn-primary btn-block">Cadastrar</button> </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small "  >Já possui cadastro? <a class="text-decoration-none" href="{{route('login')}}">Realizar o Login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
    </div>
@endsection