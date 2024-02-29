<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">

    {{-- adicionado bootstrap com vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js']);

    <title>Laravel</title>
</head>
<body class="sb-nav-fixed sb-sidenav-toggled">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">Curso de Laravel</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{route('perfil-show')}}"><i class="fa-solid fa-user"></i> Perfil</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="{{route('sair')}}"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a  @class(['nav-link', 'active' => isset($menu) && $menu=='dashboard']) class="nav-link" href="{{route('dashboard')}}" >
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        @can('index-curso')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu=='cursos']) class="nav-link" href="{{route('curso.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                                Cursos
                            </a>
                        @endcan

                        @can('index-usuario')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu=='users']) class="nav-link" href="{{route('usuario.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                Usuários
                            </a>
                        @endcan

                        @can('index-role')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu=='roles']) class="nav-link" href="{{route('role-index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-network-wired"></i></div>
                                Tipos de Usuários
                            </a>
                        @endcan

                        @can('index-permission')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu=='permissions']) class="nav-link" href="{{route('permission-index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-file"></i></div>
                                Permissões
                            </a>
                        @endcan


                        <a class="nav-link" href="{{route('sair')}}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                            Sair
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logado:
                        @if (auth()->check())
                            {{(Auth::user()->name)}}
                        @endif
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>

            {{-- rodape --}}
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; André Santos {{date('Y')}}</div>
                        <div>
                            <a href="#" class="text-decoration-none">Política de Privicidade</a>
                            &middot;
                            <a href="#" class="text-decoration-none">Termos &amp; Condições</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
