@extends('layouts.app')

@section('title', 'Edit Profil - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 md:p-12 rounded-2xl shadow-2xl border border-gray-100">

            <div class="flex flex-col sm:flex-row items-center justify-between mb-8 pb-6 border-b border-gray-200">
                <div>
                    <h2 class="text-3xl font-extrabold text-blue-900">Edit Profil</h2>
                    <p class="mt-2 text-sm text-gray-500">Perbarui informasi pribadi dan kelola kata sandi Anda.</p>
                </div>
                <a href="{{ route('profile.show') }}" class="btn btn-ghost text-blue-600 hover:bg-blue-50 mt-4 sm:mt-0">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Dasar</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-8">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror"
                               placeholder="Masukkan nama lengkap" required>
                        @error('nama')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                               placeholder="Masukkan email" required>
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                        <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('whatsapp') border-red-500 @enderror"
                               placeholder="Contoh: 08123456789">
                        @error('whatsapp')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $user->tempat_lahir) }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('tempat_lahir') border-red-500 @enderror"
                               placeholder="Masukkan tempat lahir">
                        @error('tempat_lahir')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                               value="{{ old('tanggal_lahir', $user->tanggal_lahir ? $user->tanggal_lahir->format('Y-m-d') : '') }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_lahir') border-red-500 @enderror">
                        @error('tanggal_lahir')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="golongan_darah" class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                        <select id="golongan_darah" name="golongan_darah" class="select select-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('golongan_darah') border-red-500 @enderror">
                            <option value="" disabled selected class="text-gray-400">Pilih Golongan Darah</option>
                            <option value="A" {{ old('golongan_darah', $user->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('golongan_darah', $user->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                            <option value="AB" {{ old('golongan_darah', $user->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                            <option value="O" {{ old('golongan_darah', $user->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
                        </select>
                        @error('golongan_darah')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-6 mt-8 pt-4 border-t border-gray-200">Ubah Password (Opsional)</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-6">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('current_password') border-red-500 @enderror"
                               placeholder="Password saat ini">
                        @error('current_password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" id="password" name="password"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                               placeholder="Password baru">
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Konfirmasi password">
                    </div>
                </div>

                <div class="mt-12 flex justify-end gap-4">
                    <a href="{{ route('profile.show') }}" class="btn btn-ghost text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn bg-blue-600 text-white hover:bg-blue-700 shadow-md">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
