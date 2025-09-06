@extends('layouts.app')

@section('title', 'Edit Jadwal Ibadah - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200">
            <div>
                <h1 class="text-3xl font-extrabold text-blue-900">Edit Jadwal Ibadah</h1>
                <p class="mt-2 text-sm text-gray-500">Perbarui jadwal ibadah: {{ $ibadah->nama }}</p>
            </div>
            <a href="{{ route('ibadah.show', $ibadah) }}" class="btn btn-ghost text-gray-600 hover:bg-gray-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white p-8 md:p-12 rounded-2xl shadow-2xl border border-gray-100">
            <form action="{{ route('ibadah.update', $ibadah) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <!-- Nama Ibadah -->
                    <div class="md:col-span-2">
                        <label class="label block text-sm font-medium text-gray-700 mb-1">
                            Nama Ibadah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama', $ibadah->nama) }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror"
                               placeholder="Contoh: Ibadah Minggu, Ibadah Pemuda, dll">
                        @error('nama')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal & Waktu -->
                    <div class="form-control">
                        <label class="label block text-sm font-medium text-gray-700 mb-1">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $ibadah->tanggal->format('Y-m-d')) }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('tanggal') border-red-500 @enderror">
                        @error('tanggal')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label block text-sm font-medium text-gray-700 mb-1">
                            Waktu <span class="text-red-500">*</span>
                        </label>
                        <input type="time" name="waktu" value="{{ old('waktu', $ibadah->waktu->format('H:i')) }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('waktu') border-red-500 @enderror">
                        @error('waktu')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi & Pemimpin -->
                    <div class="form-control">
                        <label class="label block text-sm font-medium text-gray-700 mb-1">
                            Lokasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $ibadah->lokasi) }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('lokasi') border-red-500 @enderror"
                               placeholder="Contoh: Gereja AMGPM Parthenos, Aula, dll">
                        @error('lokasi')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label block text-sm font-medium text-gray-700 mb-1">
                            Pemimpin Ibadah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="pemimpin" value="{{ old('pemimpin', $ibadah->pemimpin) }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('pemimpin') border-red-500 @enderror"
                               placeholder="Nama pemimpin ibadah">
                        @error('pemimpin')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pemandu & Tema -->
                    <div class="form-control">
                        <label class="label block text-sm font-medium text-gray-700 mb-1">
                            Pemandu Ibadah
                        </label>
                        <input type="text" name="pemandu" value="{{ old('pemandu', $ibadah->pemandu) }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('pemandu') border-red-500 @enderror"
                               placeholder="Nama pemandu ibadah (opsional)">
                        @error('pemandu')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label block text-sm font-medium text-gray-700 mb-1">
                            Tema Ibadah
                        </label>
                        <input type="text" name="tema" value="{{ old('tema', $ibadah->tema) }}"
                               class="input input-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('tema') border-red-500 @enderror"
                               placeholder="Tema atau judul ibadah (opsional)">
                        @error('tema')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catatan -->
                    <div class="form-control md:col-span-2">
                        <label class="label block text-sm font-medium text-gray-700 mb-1">
                            Catatan
                        </label>
                        <textarea name="catatan" rows="4"
                                  class="textarea textarea-bordered w-full rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('catatan') border-red-500 @enderror"
                                  placeholder="Catatan tambahan untuk ibadah ini (opsional)">{{ old('catatan', $ibadah->catatan) }}</textarea>
                        @error('catatan')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-12 flex justify-end gap-4">
                    <a href="{{ route('ibadah.show', $ibadah) }}" class="btn btn-ghost text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn bg-blue-600 text-white hover:bg-blue-700 shadow-md">
                        <i class="fas fa-save mr-2"></i>
                        Perbarui Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
