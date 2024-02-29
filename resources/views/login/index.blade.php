@extends('layouts.login')

@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                <div class="card-body">
                                    <x-alert/>
                                    <form method="post" action="{{route('logar')}}">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="email" type="email" placeholder="E-mail do usuário" value="{{old('email')}}" />
                                            <label for="email">E-mail</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="senha" id="senha" type="password" placeholder="Senha de minímo 6 digitos" value="{{old('senha')}}"/>
                                            <label for="senha">Senha</label>
                                        </div>
                                    
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small text-decoration-none" href="{{route('esqueceu-senha.form')}}">Esquece a Senha?</a>
                                             <button type="submit" class="btn btn-primary">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small "  ><a class="text-decoration-none" href="{{route('login-create')}}">Cadastre-se</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
    </div>
@endsection