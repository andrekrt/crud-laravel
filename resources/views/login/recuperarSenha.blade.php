@extends('layouts.login')

@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Nova Senha</h3></div>
                                <div class="card-body">
                                    <x-alert/>
                                    <form method="post" action="{{route('recuperar-senha.update')}}">
                                        @csrf
                                        <input type="hidden" value="{{$token}}" name="token">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="email" type="email" placeholder="E-mail cadastrado" value="{{old('email')}}" />
                                            <label for="email">E-mail</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="password" type="password" placeholder="Nova Senha" value="{{old('password')}}" />
                                            <label for="senha">Nova Senha</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" placeholder="Nova Senha" value="{{old('password_confirmation')}}" />
                                            <label for="password_confirmation">Confirmar Nova Senha</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                           
                                             <button type="submit" class="btn btn-primary" onclick="this.innerText='Recuperando..'">Salvar Senha</button> 
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
    </div>
@endsection