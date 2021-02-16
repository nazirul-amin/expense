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
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/glass.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
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
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
        </main> --}}

        <main class="py-4">
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-12">
                        <section class="glass">
                            <div id="dashboard">
                                <div class="user" style="margin: 2rem">
                                    <img src="/images/avatar.jpg" alt="" class="mb-3" style="width: 100px; border-radius: 50%;">
                                    <div class="pro">
                                        You are logged in!
                                    </div>
                                </div>
                                <div class="links">
                                    <div class="link">
                                        <img src="/images/twitch.png" alt="" />
                                        <router-link to="/" class="nav-item nav-link"><h2>Home</h2></router-link>
                                    </div>
                                    <div class="link">
                                        <img src="/images/steam.png" alt="" />
                                        <router-link to="/income" class="nav-item nav-link"><h2>Incomes</h2></router-link>
                                    </div>
                                    <div class="link">
                                        <img src="/images/upcoming.png" alt="" />
                                        <router-link to="/expense" class="nav-item nav-link"><h2>Expenses</h2></router-link>
                                    </div>
                                    <div class="link">
                                        <img src="/images/upcoming.png" alt="" />
                                        <router-link to="/credit" class="nav-item nav-link"><h2>Credit</h2></router-link>
                                    </div>
                                    <div class="link">
                                        <img src="/images/library.png" alt="" />
                                        <router-link to="/account" class="nav-item nav-link"><h2>Account</h2></router-link>
                                    </div>
                                </div>

                            </div>
                            <div id="dashboard2">
                                <div class="row">
                                    <div style="width: 15%;">
                                        <div class="user pl-4">
                                            <img src="/images/avatar.jpg" alt="" class="mt-2 mb-3" style="width: 30px; border-radius: 50%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row pb-1" style="padding-left: 8%">
                                    <div style="width: 15%;">
                                        <router-link to="/">Home</router-link>
                                    </div>
                                    <div style="width: 22%;">
                                        <router-link to="/income">Incomes</router-link>
                                    </div>
                                    <div style="width: 23%;">
                                        <router-link to="/expense">Expenses</router-link>
                                    </div>
                                    <div style="width: 15%;">
                                        <router-link to="/credit">Credit</router-link>
                                    </div>
                                    <div style="width: 20%;">
                                        <router-link to="/account">Account</router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="games">
                                <div class="status">
                                    <input type="text" placeholder="Search..."/>
                                </div>
                                <div class="cards">
                                    <router-view></router-view>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
