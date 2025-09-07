@extends('layouts.app')

@section('title', 'Tambah Anggota - ' . config('app.name', 'Laravel'))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-12">
    <!-- Background Decorations -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400/20 to-purple-400/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-indigo-400/20 to-pink-400/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Info Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6 mb-8">
            <div class="flex items-center gap-4">
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-full w-16 h-16 flex items-center justify-center">
                    <i class="fas fa-user-plus text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">Tambah Anggota</h1>
                    <p class="text-gray-600 mt-1">Tambahkan data anggota baru ke database</p>
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <a href="{{ route('anggota.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-2xl border border-white/20">
            <form action="{{ route('anggota.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Nama -->
                <div class="space-y-2">
                    <label for="nama" class="flex items-center text-sm font-semibold text-gray-700">
                        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        Nama Lengkap <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text"
                           id="nama"
                           name="nama"
                           value="{{ old('nama') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nama') border-red-500 focus:ring-red-500 @enderror"
                           placeholder="Masukkan nama lengkap"
                           required>
                    @error('nama')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="flex items-center text-sm font-semibold text-gray-700">
                        <div class="bg-gradient-to-br from-purple-500 to-violet-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                            <i class="fas fa-envelope text-white text-sm"></i>
                        </div>
                        Email <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 focus:ring-red-500 @enderror"
                           placeholder="Masukkan alamat email">
                    @error('email')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>



                <!-- WhatsApp -->
                <div class="space-y-2">
                    <label for="whatsapp" class="flex items-center text-sm font-semibold text-gray-700">
                        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                            <i class="fab fa-whatsapp text-white text-sm"></i>
                        </div>
                        Nomor WhatsApp <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text"
                           id="whatsapp"
                           name="whatsapp"
                           value="{{ old('whatsapp') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 @error('whatsapp') border-red-500 focus:ring-red-500 @enderror"
                           placeholder="Contoh: 08123456789">
                    @error('whatsapp')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tempat Lahir -->
                    <div class="space-y-2">
                        <label for="tempat_lahir" class="flex items-center text-sm font-semibold text-gray-700">
                            <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-white text-sm"></i>
                            </div>
                            Tempat Lahir <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="text"
                               id="tempat_lahir"
                               name="tempat_lahir"
                               value="{{ old('tempat_lahir') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 @error('tempat_lahir') border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Masukkan tempat lahir"
                               required>
                        @error('tempat_lahir')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="space-y-2">
                        <label for="tanggal_lahir" class="flex items-center text-sm font-semibold text-gray-700">
                            <div class="bg-gradient-to-br from-indigo-500 to-blue-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-calendar-alt text-white text-sm"></i>
                            </div>
                            Tanggal Lahir <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="date"
                               id="tanggal_lahir"
                               name="tanggal_lahir"
                               value="{{ old('tanggal_lahir') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 @error('tanggal_lahir') border-red-500 focus:ring-red-500 @enderror"
                               required>
                        @error('tanggal_lahir')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div class="space-y-2">
                    <label for="jenis_kelamin" class="flex items-center text-sm font-semibold text-gray-700">
                        <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                            <i class="fas fa-venus-mars text-white text-sm"></i>
                        </div>
                        Jenis Kelamin <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select id="jenis_kelamin"
                            name="jenis_kelamin"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('jenis_kelamin') border-red-500 focus:ring-red-500 @enderror"
                            required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Golongan Darah -->
                <div class="space-y-2">
                    <label for="golongan_darah" class="flex items-center text-sm font-semibold text-gray-700">
                        <div class="bg-gradient-to-br from-red-500 to-rose-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                            <i class="fas fa-tint text-white text-sm"></i>
                        </div>
                        Golongan Darah <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select id="golongan_darah"
                            name="golongan_darah"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 @error('golongan_darah') border-red-500 focus:ring-red-500 @enderror"
                            required>
                        <option value="">Pilih Golongan Darah</option>
                        <option value="A" {{ old('golongan_darah') === 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('golongan_darah') === 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ old('golongan_darah') === 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ old('golongan_darah') === 'O' ? 'selected' : '' }}>O</option>
                    </select>
                    @error('golongan_darah')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Status Admin -->
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl p-4">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg w-10 h-10 flex items-center justify-center">
                            <i class="fas fa-user-shield text-white"></i>
                        </div>
                        <div class="flex-1">
                            <label for="is_admin" class="flex items-center cursor-pointer">
                                <input type="checkbox"
                                       id="is_admin"
                                       name="is_admin"
                                       value="1"
                                       class="w-5 h-5 text-amber-600 bg-gray-100 border-gray-300 rounded focus:ring-amber-500 focus:ring-2 @error('is_admin') border-red-500 @enderror"
                                       {{ old('is_admin') ? 'checked' : '' }}>
                                <span class="ml-3 text-sm font-semibold text-gray-700">Berikan hak akses admin</span>
                            </label>
                            <p class="text-xs text-gray-500 mt-1">Admin dapat mengelola data ibadah dan anggota</p>
                        </div>
                    </div>
                    @error('is_admin')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-8 border-t border-gray-200">
                    <a href="{{ route('anggota.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
