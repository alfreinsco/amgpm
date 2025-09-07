@extends('layouts.app')

@section('title', 'Login - ' . config('app.name', 'Laravel'))

@section('body-class', 'bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-800 min-h-screen flex items-center justify-center p-4')

@section('main-class', 'w-full max-w-5xl')

@section('content')
<div class="grid lg:grid-cols-2 gap-8 items-center">
    <!-- Left Side - App Information (Hidden on Mobile) -->
    <div class="hidden lg:block text-white">
        <div class="space-y-6">
            <!-- Logo and Title -->
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                    <img src="{{ asset('img/logo-amgpm.png') }}" alt="AMGPM Logo" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <h1 class="text-4xl font-bold">AMGPM</h1>
                    <p class="text-xl text-blue-100">Aplikasi Manajemen</p>
                </div>
            </div>

             <!-- Login Instructions -->
             <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                 <h2 class="text-xl font-semibold mb-4 flex items-center">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                     </svg>
                     Cara Login
                 </h2>
                 <div class="space-y-3 text-blue-100">
                     <p class="leading-relaxed">
                         Anda dapat masuk menggunakan salah satu dari:
                     </p>
                     <div class="space-y-2">
                         <div class="flex items-center">
                             <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-500/20 text-blue-200 mr-3">
                                 <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                     <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                     <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                 </svg>
                                 Email
                             </span>
                             <span class="text-sm">admin@gereja.com</span>
                         </div>
                         <div class="flex items-center">
                             <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500/20 text-green-200 mr-3">
                                 <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                     <path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd"></path>
                                 </svg>
                                 WhatsApp
                             </span>
                             <span class="text-sm">081234567890</span>
                         </div>
                     </div>
                     <div class="mt-4 p-3 bg-yellow-500/10 rounded-lg border border-yellow-500/20">
                         <p class="text-yellow-200 text-sm">
                             <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                 <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                             </svg>
                             Pastikan nomor WhatsApp sudah terdaftar di sistem
                         </p>
                     </div>
                 </div>
             </div>

            <!-- Features Highlight -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 text-center">
                    <div class="w-8 h-8 bg-green-400 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">Mudah Digunakan</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 text-center">
                    <div class="w-8 h-8 bg-blue-400 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">Aman & Terpercaya</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="w-full max-w-md lg:max-w-lg mx-auto">
        <div class="card bg-base-100 shadow-2xl hover:shadow-3xl transition-all duration-300 border border-base-300">
            <div class="card-body p-8">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('img/logo-amgpm.png') }}" alt="AMGPM Logo" class="w-12 h-12 object-contain">
                    </div>
                    <h1 class="text-2xl font-bold text-base-content">AMGPM</h1>
                    <p class="text-base-content/70">Aplikasi Manajemen Gereja</p>
                </div>

                <!-- Header -->
                 <div class="text-center mb-10">
                     <h2 class="text-3xl font-bold text-base-content mb-3">Selamat Datang Kembali</h2>
                     <p class="text-base-content/70 text-lg">Masuk ke akun Anda untuk melanjutkan</p>
                     <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-600 mx-auto mt-4 rounded-full"></div>
                 </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Login Field -->
            <div class="form-control">
                <label class="label" for="login">
                    <span class="label-text font-semibold text-base-content/80 flex items-center gap-2">
                        <i class="fas fa-envelope text-blue-500"></i>
                        Email atau WhatsApp
                    </span>
                </label>
                <div class="relative">
                    <input
                        type="text"
                        id="login"
                        name="login"
                        class="input input-bordered w-full h-14 text-lg pl-12 {{ $errors->has('login') ? 'input-error' : '' }} focus:input-primary focus:shadow-lg transition-all duration-300"
                        value="{{ old('login') }}"
                        placeholder="admin@gereja.com atau 081234567890"
                        required
                        autofocus
                    >
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-base-content/50 z-10 pointer-events-none">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                @error('login')
                    <label class="label">
                        <span class="label-text-alt text-error flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                    </label>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-control">
                <label class="label" for="password">
                    <span class="label-text font-semibold text-base-content/80 flex items-center gap-2">
                        <i class="fas fa-lock text-purple-500"></i>
                        Password
                    </span>
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="input input-bordered w-full h-14 text-lg pl-12 pr-12 {{ $errors->has('password') ? 'input-error' : '' }} focus:input-primary focus:shadow-lg transition-all duration-300"
                        placeholder="Masukkan password Anda"
                        required
                    >
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-base-content/50 z-10 pointer-events-none">
                        <i class="fas fa-key"></i>
                    </div>
                    <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-base-content/50 hover:text-base-content transition-colors z-10" onclick="togglePassword()">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                    <label class="label">
                        <span class="label-text-alt text-error flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                    </label>
                @enderror
            </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-full h-14 text-lg font-semibold hover:btn-secondary hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-sign-in-alt mr-3"></i>
                    Masuk ke Sistem
                    <i class="fas fa-arrow-right ml-3"></i>
                </button>
            </form>


        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Add loading state to form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;

        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Memproses...';
        submitBtn.disabled = true;

        // Re-enable button after 5 seconds as fallback
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 5000);
    });

    // Add focus animations
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('focus', function() {
            // Add glow effect to icons only
            const iconContainers = this.parentElement.querySelectorAll('div i, button i');
            iconContainers.forEach(icon => {
                if (!icon.id || icon.id !== 'toggleIcon') {
                    icon.classList.add('text-primary');
                    icon.classList.remove('text-base-content/50');
                }
            });
        });

        input.addEventListener('blur', function() {
            // Remove glow effect from icons
            const iconContainers = this.parentElement.querySelectorAll('div i, button i');
            iconContainers.forEach(icon => {
                if (!icon.id || icon.id !== 'toggleIcon') {
                    icon.classList.remove('text-primary');
                    icon.classList.add('text-base-content/50');
                }
            });
        });
    });
</script>
@endsection
