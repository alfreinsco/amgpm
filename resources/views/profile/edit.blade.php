@extends('layouts.app')

@section('title', 'Edit Profil - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen relative overflow-hidden">
    <!-- Background Decorations -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-blue-200/20 to-purple-200/20 rounded-full -translate-y-48 translate-x-48"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-pink-200/20 to-orange-200/20 rounded-full translate-y-40 -translate-x-40"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white/80 backdrop-blur-sm p-8 md:p-12 rounded-3xl shadow-2xl border border-white/50 ring-1 ring-gray-200/50">

            <div class="flex flex-col sm:flex-row items-center justify-between mb-10 pb-8 border-b border-gradient-to-r from-transparent via-gray-200 to-transparent">
                <div class="text-center sm:text-left">
                    <div class="flex items-center justify-center sm:justify-start mb-3">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-user-edit text-white text-xl"></i>
                        </div>
                        <h2 class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Edit Profil</h2>
                    </div>
                    <p class="text-gray-600 text-lg">Perbarui informasi pribadi dan kelola kata sandi Anda dengan mudah</p>
                </div>
                <a href="{{ route('profile.show') }}" class="btn bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 hover:from-gray-200 hover:to-gray-300 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 mt-6 sm:mt-0">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <!-- Personal Information Section -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl border border-blue-100 shadow-lg mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Informasi Dasar</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            <label for="nama" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                                Nama Lengkap <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}"
                                   class="input input-bordered w-full rounded-xl bg-white border-2 border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('nama') border-red-500 @enderror"
                                   placeholder="Masukkan nama lengkap" required>
                            @error('nama')
                                <p class="mt-2 text-xs text-red-500 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-blue-500 mr-2"></i>
                                Email <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="input input-bordered w-full rounded-xl bg-white border-2 border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('email') border-red-500 @enderror"
                                   placeholder="Masukkan email" required>
                            @error('email')
                                <p class="mt-2 text-xs text-red-500 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="whatsapp" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fab fa-whatsapp text-green-500 mr-2"></i>
                                WhatsApp
                            </label>
                            <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}"
                                   class="input input-bordered w-full rounded-xl bg-white border-2 border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 @error('whatsapp') border-red-500 @enderror"
                                   placeholder="Contoh: 08123456789">
                            @error('whatsapp')
                                <p class="mt-2 text-xs text-red-500 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tempat_lahir" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                Tempat Lahir
                            </label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $user->tempat_lahir) }}"
                                   class="input input-bordered w-full rounded-xl bg-white border-2 border-gray-200 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 @error('tempat_lahir') border-red-500 @enderror"
                                   placeholder="Masukkan tempat lahir">
                            @error('tempat_lahir')
                                <p class="mt-2 text-xs text-red-500 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_lahir" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar-alt text-purple-500 mr-2"></i>
                                Tanggal Lahir
                            </label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                   value="{{ old('tanggal_lahir', $user->tanggal_lahir ? $user->tanggal_lahir->format('Y-m-d') : '') }}"
                                   class="input input-bordered w-full rounded-xl bg-white border-2 border-gray-200 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 @error('tanggal_lahir') border-red-500 @enderror">
                            @error('tanggal_lahir')
                                <p class="mt-2 text-xs text-red-500 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="golongan_darah" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tint text-red-600 mr-2"></i>
                                Golongan Darah
                            </label>
                            <select id="golongan_darah" name="golongan_darah" class="select select-bordered w-full rounded-xl bg-white border-2 border-gray-200 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 @error('golongan_darah') border-red-500 @enderror">
                                <option value="" disabled selected class="text-gray-400">Pilih Golongan Darah</option>
                                <option value="A" {{ old('golongan_darah', $user->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('golongan_darah', $user->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('golongan_darah', $user->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('golongan_darah', $user->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                            @error('golongan_darah')
                                <p class="mt-2 text-xs text-red-500 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="bg-gradient-to-br from-orange-50 to-red-50 p-8 rounded-2xl border border-orange-100 shadow-lg mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-lock text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Ubah Password (Opsional)</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-6">
                        <div>
                            <label for="current_password" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-key text-orange-500 mr-2"></i>
                                Password Saat Ini
                            </label>
                            <input type="password" id="current_password" name="current_password"
                                   class="input input-bordered w-full rounded-xl bg-white border-2 border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 @error('current_password') border-red-500 @enderror"
                                   placeholder="Password saat ini">
                            @error('current_password')
                                <p class="mt-2 text-xs text-red-500 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-green-500 mr-2"></i>
                                Password Baru
                            </label>
                            <input type="password" id="password" name="password"
                                   class="input input-bordered w-full rounded-xl bg-white border-2 border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 @error('password') border-red-500 @enderror"
                                   placeholder="Password baru">
                            @error('password')
                                <p class="mt-2 text-xs text-red-500 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                                Konfirmasi Password
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="input input-bordered w-full rounded-xl bg-white border-2 border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                   placeholder="Konfirmasi password">
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex flex-col sm:flex-row justify-end gap-4">
                    <a href="{{ route('profile.show') }}" class="btn bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 hover:from-gray-200 hover:to-gray-300 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-200">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
