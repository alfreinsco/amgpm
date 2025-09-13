@extends('layouts.app')

@section('title', 'Profil Saya - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div role="alert" class="alert alert-success mb-6 rounded-xl border-l-4 border-green-500 bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white/80 backdrop-blur-sm p-8 md:p-12 rounded-3xl shadow-2xl border border-white/20 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-purple-500/5 to-pink-500/5"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/10 to-purple-400/10 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-pink-400/10 to-orange-400/10 rounded-full translate-y-12 -translate-x-12"></div>

            <div class="relative z-10">
                <!-- Profile Header -->
                <div class="flex flex-col lg:flex-row items-center justify-between mb-10 pb-8 border-b border-gradient-to-r from-transparent via-gray-200 to-transparent">
                    <div class="flex flex-col lg:flex-row items-center lg:items-start space-y-4 lg:space-y-0 lg:space-x-6">
                        <!-- Avatar -->
                        <div class="relative">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                     alt="Foto Profil {{ $user->nama }}" 
                                     class="w-24 h-24 rounded-full object-cover shadow-xl ring-4 ring-white/50">
                            @else
                                <div class="w-24 h-24 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-xl ring-4 ring-white/50">
                                    {{ strtoupper(substr($user->nama ?? 'U', 0, 1)) }}
                                </div>
                            @endif
                            @if($user->is_admin)
                                <div class="absolute -top-2 -right-2 w-8 h-8 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow-lg">
                                    <i class="fas fa-crown text-white text-xs"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Profile Info -->
                        <div class="text-center lg:text-left">
                            <h2 class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">{{ $user->nama ?? 'Pengguna' }}</h2>
                            <p class="mt-2 text-lg text-gray-600">{{ $user->email }}</p>
                            <div class="flex items-center justify-center lg:justify-start mt-3 space-x-4">
                                @if($user->is_admin)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-yellow-100 to-orange-100 text-orange-800 border border-orange-200">
                                        <i class="fas fa-user-shield mr-1"></i>
                                        Administrator
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-blue-100 to-indigo-100 text-indigo-800 border border-indigo-200">
                                        <i class="fas fa-user mr-1"></i>
                                        Anggota
                                    </span>
                                @endif
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-green-100 to-emerald-100 text-emerald-800 border border-emerald-200">
                                    <i class="fas fa-calendar-check mr-1"></i>
                                    Bergabung {{ $user->created_at->format('Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="btn bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-200 mt-6 lg:mt-0">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Profil
                    </a>
                </div>

                <!-- Information Cards -->
                 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Personal Information Card -->
                     <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl border border-blue-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Informasi Pribadi</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Nama Lengkap</span>
                                <span class="text-sm font-semibold text-gray-800">{{ $user->nama ?? 'Belum diisi' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Email</span>
                                <span class="text-sm font-semibold text-blue-600">{{ Str::limit($user->email, 20) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Card -->
                     <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-8 rounded-2xl border border-green-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Kontak</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">WhatsApp</span>
                                @if($user->whatsapp)
                                    <a href="https://wa.me/{{ $user->whatsapp }}" class="text-sm font-semibold text-green-600 hover:text-green-700">
                                        {{ $user->whatsapp }}
                                    </a>
                                @else
                                    <span class="text-sm text-gray-400">Belum diisi</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Birth Information Card -->
                     <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl border border-purple-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-birthday-cake text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Kelahiran</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Tempat Lahir</span>
                                <span class="text-sm font-semibold text-gray-800">{{ $user->tempat_lahir ?? 'Belum diisi' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Tanggal Lahir</span>
                                <span class="text-sm font-semibold text-purple-600">
                                    {{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d M Y') : 'Belum diisi' }}
                                </span>
                            </div>
                            @if($user->tanggal_lahir)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-600">Usia</span>
                                    <span class="text-sm font-semibold text-pink-600">
                                        {{ \Carbon\Carbon::parse($user->tanggal_lahir)->age }} tahun
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Health Information Card -->
                     <div class="bg-gradient-to-br from-red-50 to-orange-50 p-8 rounded-2xl border border-red-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-orange-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-heartbeat text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Kesehatan</h3>
                        </div>
                        <div class="space-y-4 mb-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Jenis Kelamin</span>
                                @if($user->jenis_kelamin)
                                    <span class="text-sm font-semibold text-orange-600">{{ $user->jk }}</span>
                                @else
                                    <span class="text-sm text-gray-400">Belum diisi</span>
                                @endif
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Golongan Darah</span>
                                @if($user->golongan_darah)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                        {{ $user->golongan_darah }}
                                    </span>
                                @else
                                    <span class="text-sm text-gray-400">Belum diisi</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Account Information Card -->
                     <div class="bg-gradient-to-br from-yellow-50 to-amber-50 p-8 rounded-2xl border border-yellow-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-amber-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Akun</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Bergabung</span>
                                <span class="text-sm font-semibold text-yellow-600">{{ $user->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Update Terakhir</span>
                                <span class="text-sm font-semibold text-amber-600">{{ $user->updated_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Card -->
                     <div class="bg-gradient-to-br from-gray-50 to-slate-50 p-8 rounded-2xl border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-gray-500 to-slate-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-bolt text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Aksi Cepat</h3>
                        </div>
                        <div class="space-y-3">
                            <a href="{{ route('profile.edit') }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-white/50 transition-colors">
                                <span class="text-sm font-medium text-gray-600">Edit Profil</span>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </a>
                            <a href="{{ route('dashboard') }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-white/50 transition-colors">
                                <span class="text-sm font-medium text-gray-600">Dashboard</span>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
