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
            <!-- Modern Navbar with Gradient Background -->
            <div class="navbar bg-white/95 backdrop-blur-md shadow-lg border-b border-gray-200/50 fixed top-0 left-0 right-0 z-50">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-white/95 backdrop-blur-md"></div>
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23000000" fill-opacity="0.02"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>

                <div class="navbar-start relative z-10">
                    <!-- Mobile Menu Button -->
                    <div class="dropdown">
                        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden text-gray-700 hover:bg-gray-100 border-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                            </svg>
                        </div>
                        <ul tabindex="0" class="menu menu-sm dropdown-content bg-white/95 backdrop-blur-md rounded-2xl z-[1] mt-3 w-64 p-3 shadow-2xl border border-white/20 text-gray-700">
                            @include('partials.navbar-menu')
                        </ul>
                    </div>

                    <!-- Logo and Brand -->
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xl flex items-center gap-3 text-gray-800 hover:bg-gray-100 border-none transition-all duration-300 group">
                        <div class="relative">
                            <img src="{{ asset('img/logo-amgpm.png') }}" alt="AMGPM Logo" class="h-10 w-10 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute inset-0 rounded-full bg-gray-200/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="font-bold text-lg tracking-wide">AMGPM</span>
                            <span class="text-sm font-medium text-gray-600 -mt-1">Ranting Parthenos</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="navbar-center hidden lg:flex relative z-10">
                    <ul class="menu menu-horizontal px-1 gap-2 text-gray-700">
                        @include('partials.navbar-menu')
                    </ul>
                </div>

                <!-- User Profile Dropdown -->
                <div class="navbar-end relative z-10">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost gap-2 normal-case text-gray-700 hover:bg-gray-100 border-none transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <div class="hidden sm:flex flex-col items-end">
                                    <span class="font-medium text-sm">{{ Auth::user()->nama }}</span>
                                    <span class="text-xs text-gray-500 opacity-80">{{ Auth::user()->is_admin ? 'Administrator' : 'Member' }}</span>
                                </div>
                                <div class="w-8 h-8 bg-gray-200/50 rounded-full flex items-center justify-center group-hover:bg-gray-300/50 transition-colors duration-300">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <i class="fas fa-chevron-down text-xs opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                            </div>
                        </div>
                        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-3 shadow-2xl bg-white/95 backdrop-blur-md rounded-2xl w-64 border border-white/20">
                            <!-- User Info Header -->
                            <li class="mb-2">
                                <a href="{{ route('profile.show') }}" class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl cursor-pointer hover:bg-gradient-to-r hover:from-blue-100 hover:to-indigo-100">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-gray-800">{{ Auth::user()->nama }}</span>
                                        <span class="text-xs text-gray-500">{{ Auth::user()->is_admin ? 'Administrator' : 'Member' }}</span>
                                    </div>
                                </a>
                            </li>
                            <!-- Menu Items -->
                            {{-- <li><a href="{{ route('profile.show') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-50 transition-colors duration-200"><i class="fas fa-user text-green-600"></i><span class="font-medium">Profil Saya</span></a></li> --}}
                            @if(Auth::check() && Auth::user()->is_admin)
                            <li>
                                <a href="{{ route('pengaturan.whatsapp.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-50 transition-colors duration-200">
                                    <i class="fas fa-gear text-gray-600"></i>
                                    <span class="font-medium">Pengaturan</span>
                                </a>
                            </li>
                            <li class="divider my-2"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-red-50 transition-colors duration-200 text-left">
                                        <i class="fas fa-sign-out-alt text-red-600"></i>
                                        <span class="font-medium text-red-600">Logout</span>
                                    </button>
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
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
</body>
</html>
