<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="@yield('theme', 'light')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="icon" href="{{ asset('img/logo-amgpm.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="@yield('body-class', 'bg-base-100 min-h-screen bg-gray-50 pt-16')">
    <div id="app">
        @auth
            <div class="navbar bg-base-100 shadow-lg fixed top-0 left-0 right-0 z-50">
                <div class="navbar-start">
                    <div class="dropdown">
                        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                            </svg>
                        </div>
                        <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                            @include('partials.navbar-menu')
                        </ul>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xl flex items-center gap-4">
                        <img src="{{ asset('img/logo-amgpm.png') }}" alt="AMGPM Logo" class="h-8 w-8">
                        <div class="flex flex-col items-start">
                            <span>AMGPM</span>
                            <span class="text-sm font-normal -mt-1">Ranting Parthenos</span>
                        </div>
                    </a>
                </div>

                <div class="navbar-center hidden lg:flex">
                    <ul class="menu menu-horizontal px-1">
                        @include('partials.navbar-menu')
                    </ul>
                </div>

            <div class="navbar-end">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost gap-1 normal-case">
                            <span class="hidden sm:inline">{{ Auth::user()->nama }}</span>
                            <i class="fas fa-user sm:hidden"></i>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a class="justify-between">{{ Auth::user()->nama }}</a></li>
                            <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
                            <li><a href="{{ route('ibadah.index') }}"><i class="fas fa-church mr-2"></i>Jadwal Ibadah</a></li>
                            <li><a href="{{ route('profile.show') }}"><i class="fas fa-user mr-2"></i>Profil Saya</a></li>
                            <li class="divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endauth

        @if (session('status'))
            <div class="alert alert-success mx-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error mx-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h3 class="font-bold">Terjadi kesalahan!</h3>
                    <ul class="mt-1 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <main class="@yield('main-class', 'container mx-auto px-4 py-8')">
            @yield('content')
        </main>
    </div>

    @hasSection('footer')
        <footer class="footer footer-center p-10 bg-base-200 text-base-content rounded">
            <div>
                @yield('footer')
            </div>
        </footer>
    @endif

    @stack('scripts')
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
