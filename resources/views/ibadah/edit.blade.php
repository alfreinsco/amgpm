@extends('layouts.app')

@section('title', 'Edit Jadwal Ibadah - ' . config('app.name', 'Laravel'))

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
                <div class="bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full w-16 h-16 flex items-center justify-center">
                    <i class="fas fa-edit text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent">Edit Jadwal Ibadah</h1>
                    <p class="text-gray-600 mt-1">Perbarui jadwal ibadah: {{ $ibadah->nama }}</p>
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <a href="{{ route('ibadah.show', $ibadah) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white/90 backdrop-blur-sm p-8 md:p-12 rounded-2xl shadow-2xl border border-white/20">
            <form action="{{ route('ibadah.update', $ibadah) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-8">
                    <!-- Nama Ibadah -->
                    <div class="md:col-span-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-church text-white text-sm"></i>
                            </div>
                            Nama Ibadah <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama', $ibadah->nama) }}"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-200 bg-white/80 @error('nama') border-red-500 @enderror"
                               placeholder="Contoh: Ibadah Minggu, Ibadah Pemuda, dll">
                        @error('nama')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                            <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-calendar text-white text-sm"></i>
                            </div>
                            Tanggal <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $ibadah->tanggal->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-200 bg-white/80 @error('tanggal') border-red-500 @enderror">
                        @error('tanggal')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Waktu -->
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                            <div class="bg-gradient-to-br from-purple-500 to-violet-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-clock text-white text-sm"></i>
                            </div>
                            Waktu <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="time" name="waktu" value="{{ old('waktu', $ibadah->waktu->format('H:i')) }}"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-all duration-200 bg-white/80 @error('waktu') border-red-500 @enderror">
                        @error('waktu')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Lokasi & Pemimpin -->
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                            <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-white text-sm"></i>
                            </div>
                            Lokasi <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $ibadah->lokasi) }}"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/20 transition-all duration-200 bg-white/80 @error('lokasi') border-red-500 @enderror"
                               placeholder="Contoh: Gereja AMGPM Parthenos, Aula, dll">
                        @error('lokasi')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                            <div class="bg-gradient-to-br from-indigo-500 to-blue-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-user-tie text-white text-sm"></i>
                            </div>
                            Pemimpin Ibadah <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="text" name="pemimpin" value="{{ old('pemimpin', $ibadah->pemimpin) }}"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-200 bg-white/80 @error('pemimpin') border-red-500 @enderror"
                               placeholder="Nama pemimpin ibadah">
                        @error('pemimpin')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Pemandu & Tema -->
                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                            <div class="bg-gradient-to-br from-teal-500 to-cyan-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            Pemandu Ibadah
                        </label>
                        <input type="text" name="pemandu" value="{{ old('pemandu', $ibadah->pemandu) }}"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all duration-200 bg-white/80 @error('pemandu') border-red-500 @enderror"
                               placeholder="Nama pemandu ibadah (opsional)">
                        @error('pemandu')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                            <div class="bg-gradient-to-br from-pink-500 to-rose-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-lightbulb text-white text-sm"></i>
                            </div>
                            Tema Ibadah
                        </label>
                        <input type="text" name="tema" value="{{ old('tema', $ibadah->tema) }}"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-pink-500 focus:ring-4 focus:ring-pink-500/20 transition-all duration-200 bg-white/80 @error('tema') border-red-500 @enderror"
                               placeholder="Tema atau judul ibadah (opsional)">
                        @error('tema')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Catatan -->
                    <div class="md:col-span-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                            <div class="bg-gradient-to-br from-gray-500 to-slate-600 rounded-lg w-8 h-8 flex items-center justify-center mr-3">
                                <i class="fas fa-sticky-note text-white text-sm"></i>
                            </div>
                            Catatan
                        </label>
                        <textarea name="catatan" rows="4"
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-gray-500 focus:ring-4 focus:ring-gray-500/20 transition-all duration-200 bg-white/80 resize-none @error('catatan') border-red-500 @enderror"
                                  placeholder="Catatan tambahan untuk ibadah ini (opsional)">{{ old('catatan', $ibadah->catatan) }}</textarea>
                        @error('catatan')
                            <p class="mt-2 text-sm text-red-500 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-12 flex flex-col sm:flex-row justify-end gap-4">
                    <a href="{{ route('ibadah.show', $ibadah) }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition-all duration-200 font-medium">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-yellow-600 to-orange-600 hover:from-yellow-700 hover:to-orange-700 text-white rounded-xl transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>
                        Perbarui Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
