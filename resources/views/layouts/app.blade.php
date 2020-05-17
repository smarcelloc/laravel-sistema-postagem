@php
    $route = explode('.',Route::current()->getName())[0] ?? 'home';
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-warning shadow-sm">
            <div class="container">
                <a class="navbar-brand font-weight-bolder" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto font-weight-bold">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item @if ($route == 'login') active @endif">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Login
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item @if ($route == 'register') active @endif">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus"></i>
                                        Registrar
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item @if ($route == 'home') active @endif">
                                <a class="nav-link" href="{{ route('home') }}">
                                    <i class="fas fa-home"></i>
                                    Home
                                </a>
                            </li>
                            @can('news-index')
                            <li class="nav-item @if ($route == 'news') active @endif">
                                <a class="nav-link" href="{{ route('news.index') }}">
                                    <i class="fas fa-newspaper"></i>
                                    Meus Posts
                                </a>
                            </li>
                            @endcan()
                            @can('user-index')
                            <li class="nav-item @if ($route == 'user') active @endif">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    <i class="fas fa-users"></i>
                                    Usuários
                                </a>
                            </li>
                            @endcan()
                            @can('role-index')
                            <li class="nav-item @if ($route == 'role') active @endif">
                                <a class="nav-link" href="{{ route('role.index') }}">
                                    <i class="fas fa-key"></i>
                                    Regras
                                </a>
                            </li>
                            @endcan()
                            @can('role-index')
                            <li class="nav-item @if ($route == 'permission') active @endif">
                                <a class="nav-link" href="{{ route('permission.index') }}">
                                    <i class="fas fa-th-large"></i>
                                    Permissões
                                </a>
                            </li>
                            @endcan()
                            <li class="nav-item dropdown  @if ($route == 'profile') active @endif">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user"></i>
                                    {{ Str::limit(explode(' ', Auth::user()->name)[0], 20) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-user-edit"></i>
                                         Meu perfil
                                     </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Sair
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
