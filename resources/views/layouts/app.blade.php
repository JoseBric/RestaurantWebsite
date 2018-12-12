<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/black.png') }}"/>
</head>
<body id="@yield('id', null)">
    <div id="app">
        <header>
            <div id="navbar-wrapper">
                <nav id="navbar" class="navbar navbar-expand-md navbar-light navbar-laravel">
                        <div class="navbar-collapse" id="navbarSupportedContent">
                            <div class="hamburgerButton">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                            <div id="nav-links">
                                <div class="left">
                                    <a class="navbar-brand" href="{{ url('/') }}">
                                        <img id="logo" src="/img/logo.png" alt="">
                                    </a>
                                </div>
                                <div class="centered">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a href="/menu" class="nav-link">Menu</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/about_us" class="nav-link">About Us</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/locations" class="nav-link">Locations</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="right">
                                    <ul class="navbar-nav">
                                        @guest
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">Admin</a>
                                        </li>
                                        @else
                                        <li class="nav-item dropdown dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }} <span class="caret"></span>
                                            </a>
                                            
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item text-dark" href="/dish">
                                                    Dashboard
                                                </a>
                                                <a class="dropdown-item text-dark" href="/user/{{ Auth::user()->id }}/">
                                                    Profile
                                                </a>
                                                <a class="dropdown-item text-dark" href="/locations/admin">
                                                    Add Locations
                                                </a>
                                                <a class="dropdown-item text-dark" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                    Log Out
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
                    </div>
            </nav>
        </div>
        @yield("header")
    </header>
        <main id="main">
            <div id="hello"></div>
            @yield("content")
        </main>
    </div>
    @yield('script')
</body>
</html>
