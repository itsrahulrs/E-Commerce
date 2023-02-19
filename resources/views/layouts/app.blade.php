<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Commerce') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'E-Commerce') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Products') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('products.index') }}">
                                    {{ __('All Products') }}
                                </a>
                                @auth
                                    @role('Employee')
                                    <a class="dropdown-item" href="{{ route('products.create') }}">
                                        {{ __('Create Product') }}
                                    </a>
                                    @endrole
                                    @role('Admin')
                                    <a class="dropdown-item" href="{{ route('products.newProducts') }}">
                                        {{ __('New Products (not approved)') }}
                                    </a>
                                    @endrole
                                @endauth
                            </div>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('cart') }}">
                                    {{ __('Cart') }}
                                    <span class="badge bg-danger">
                                        @if (session('cart'))
                                            {{ count(session('cart')) }}
                                        @else 0
                                        @endif
                                    </span>
                                </a>
                            </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @role('Admin')
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Users') }}
                                </a>
                            
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.index') }}">
                                        {{ __('All Users') }}
                                    </a>
                                    @auth
                                        <a class="dropdown-item" href="{{ route('users.create') }}">
                                            {{ __('Create User') }}
                                        </a>
                                    @endauth
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Roles') }}
                                </a>
                            
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('roles.index') }}">
                                        {{ __('All Roles') }}
                                    </a>
                                    @auth
                                        <a class="dropdown-item" href="{{ route('roles.create') }}">
                                            {{ __('Create Role') }}
                                        </a>
                                    @endauth
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('Orders.index') }}">
                                    {{ __('All Orders') }}
                                </a>
                            </li>
                        @endrole
                        @role('Customer')
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('myOrders') }}">
                                    {{ __('My Orders') }}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('cart') }}">
                                    {{ __('Cart') }}
                                    <span class="badge bg-danger">
                                        @if (session('cart'))
                                            {{ count(session('cart')) }}
                                        @else 0
                                        @endif
                                    </span>
                                </a>
                            </li>
                        @endrole
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
    @yield('scripts')
</body>
</html>
