@extends('layouts.app')

@section('title', 'Login - ' . config('app.name', 'Laravel'))

@section('body-class', 'bg-gradient-to-br from-primary to-secondary min-h-screen flex items-center justify-center p-4')

@section('main-class', 'w-full max-w-md')

@section('content')
<div class="card bg-base-100 shadow-2xl">
    <div class="card-body">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-base-content mb-2">Selamat Datang</h1>
            <p class="text-base-content/70">Masuk ke akun Anda</p>
        </div>
        
        <!-- Info Alert -->
        <div class="alert alert-info mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <div class="font-bold">Cara Login:</div>
                <div class="text-xs">Anda dapat login menggunakan <strong>Email</strong> atau <strong>WhatsApp</strong> yang terdaftar.</div>
            </div>
        </div>
        
        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            
            <!-- Login Field -->
            <div class="form-control">
                <label class="label" for="login">
                    <span class="label-text font-medium">Email atau WhatsApp</span>
                </label>
                <input 
                    type="text" 
                    id="login" 
                    name="login" 
                    class="input input-bordered w-full {{ $errors->has('login') ? 'input-error' : '' }}" 
                    value="{{ old('login') }}"
                    placeholder="Masukkan email atau nomor WhatsApp"
                    required
                    autofocus
                >
                @error('login')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>
            
            <!-- Password Field -->
            <div class="form-control">
                <label class="label" for="password">
                    <span class="label-text font-medium">Password</span>
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="input input-bordered w-full {{ $errors->has('password') ? 'input-error' : '' }}"
                    placeholder="Masukkan password Anda"
                    required
                >
                @error('password')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>
            
            <!-- Remember & Forgot -->
            <div class="flex justify-between items-center mt-4">
                <label class="label cursor-pointer">
                    <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm" {{ old('remember') ? 'checked' : '' }}>
                    <span class="label-text ml-2">Ingat saya</span>
                </label>
                <a href="#" class="link link-primary text-sm">Lupa password?</a>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-full mt-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                Masuk
            </button>
        </form>
    </div>
</div>
@endsection