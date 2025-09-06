@extends('layouts.app')

@section('title', 'Tambah Anggota - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200">
            <div>
                <h1 class="text-3xl font-extrabold text-blue-900">Tambah Anggota</h1>
                <p class="mt-2 text-sm text-gray-500">Tambahkan data anggota baru ke database</p>
            </div>
            <a href="{{ route('anggota.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-xl border border-gray-100">
            <form action="{{ route('anggota.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-1"></i>
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}"
                           class="input input-bordered w-full @error('nama') input-error @enderror"
                           placeholder="Masukkan nama lengkap"
                           required>
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-1"></i>
                        Email
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           class="input input-bordered w-full @error('email') input-error @enderror"
                           placeholder="Masukkan alamat email">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-1"></i>
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="input input-bordered w-full @error('password') input-error @enderror"
                           placeholder="Masukkan password (minimal 8 karakter)"
                           required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- WhatsApp -->
                <div>
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fab fa-whatsapp mr-1"></i>
                        Nomor WhatsApp
                    </label>
                    <input type="text" 
                           id="whatsapp" 
                           name="whatsapp" 
                           value="{{ old('whatsapp') }}"
                           class="input input-bordered w-full @error('whatsapp') input-error @enderror"
                           placeholder="Contoh: 08123456789">
                    @error('whatsapp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tempat Lahir -->
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="tempat_lahir" 
                               name="tempat_lahir" 
                               value="{{ old('tempat_lahir') }}"
                               class="input input-bordered w-full @error('tempat_lahir') input-error @enderror"
                               placeholder="Masukkan tempat lahir"
                               required>
                        @error('tempat_lahir')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               id="tanggal_lahir" 
                               name="tanggal_lahir" 
                               value="{{ old('tanggal_lahir') }}"
                               class="input input-bordered w-full @error('tanggal_lahir') input-error @enderror"
                               required>
                        @error('tanggal_lahir')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Golongan Darah -->
                <div>
                    <label for="golongan_darah" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tint mr-1"></i>
                        Golongan Darah <span class="text-red-500">*</span>
                    </label>
                    <select id="golongan_darah" 
                            name="golongan_darah" 
                            class="select select-bordered w-full @error('golongan_darah') select-error @enderror"
                            required>
                        <option value="">Pilih Golongan Darah</option>
                        <option value="A" {{ old('golongan_darah') === 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('golongan_darah') === 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ old('golongan_darah') === 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ old('golongan_darah') === 'O' ? 'selected' : '' }}>O</option>
                    </select>
                    @error('golongan_darah')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Admin -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user-shield mr-1"></i>
                        Status Admin
                    </label>
                    <div class="form-control">
                        <label class="label cursor-pointer justify-start gap-3">
                            <input type="checkbox" 
                                   name="is_admin" 
                                   value="1"
                                   class="checkbox checkbox-primary"
                                   {{ old('is_admin') ? 'checked' : '' }}>
                            <span class="label-text">Berikan hak akses admin</span>
                        </label>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Admin dapat mengelola data ibadah dan anggota</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="btn btn-primary flex-1 sm:flex-none">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Data
                    </button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-outline flex-1 sm:flex-none">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection