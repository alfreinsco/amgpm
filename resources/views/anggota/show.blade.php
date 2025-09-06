@extends('layouts.app')

@section('title', 'Detail Anggota - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200">
            <div>
                <h1 class="text-3xl font-extrabold text-blue-900">Detail Anggota</h1>
                <p class="mt-2 text-sm text-gray-500">Informasi lengkap anggota</p>
            </div>
            <a href="{{ route('anggota.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-xl border border-gray-100">
            <!-- Header Profile -->
            <div class="flex items-center mb-8 pb-6 border-b border-gray-200">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-6">
                    {{ strtoupper(substr($anggotum->nama, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $anggotum->nama }}</h2>
                    <div class="flex items-center mt-2">
                        @if($anggotum->is_admin)
                            <span class="badge badge-primary mr-2">
                                <i class="fas fa-user-shield mr-1"></i>
                                Admin
                            </span>
                        @else
                            <span class="badge badge-ghost mr-2">
                                <i class="fas fa-user mr-1"></i>
                                Anggota
                            </span>
                        @endif
                        <span class="text-sm text-gray-500">
                            Bergabung {{ $anggotum->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Detail Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Informasi Kontak -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                        <i class="fas fa-address-book mr-2 text-blue-600"></i>
                        Informasi Kontak
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-envelope text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-gray-900">{{ $anggotum->email ?: 'Tidak ada' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <i class="fab fa-whatsapp text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">WhatsApp</p>
                                <p class="text-gray-900">{{ $anggotum->whatsapp ?: 'Tidak ada' }}</p>
                                @if($anggotum->whatsapp)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $anggotum->whatsapp) }}" 
                                       target="_blank" 
                                       class="text-green-600 hover:text-green-700 text-sm">
                                        <i class="fas fa-external-link-alt mr-1"></i>
                                        Kirim Pesan
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Personal -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                        <i class="fas fa-user-circle mr-2 text-purple-600"></i>
                        Informasi Personal
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-map-marker-alt text-purple-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tempat Lahir</p>
                                <p class="text-gray-900">{{ $anggotum->tempat_lahir ?: 'Tidak ada' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-calendar-alt text-orange-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                                <p class="text-gray-900">
                                    @if($anggotum->tanggal_lahir)
                                        {{ \Carbon\Carbon::parse($anggotum->tanggal_lahir)->format('d F Y') }}
                                        <span class="text-sm text-gray-500">
                                            ({{ \Carbon\Carbon::parse($anggotum->tanggal_lahir)->age }} tahun)
                                        </span>
                                    @else
                                        Tidak ada
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-tint text-red-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Golongan Darah</p>
                                <p class="text-gray-900">{{ $anggotum->golongan_darah ?: 'Tidak ada' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Sistem -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-info-circle mr-2 text-gray-600"></i>
                    Informasi Sistem
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="font-medium text-gray-500">Dibuat</p>
                        <p class="text-gray-900">{{ $anggotum->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="font-medium text-gray-500">Terakhir Diupdate</p>
                        <p class="text-gray-900">{{ $anggotum->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="font-medium text-gray-500">ID Anggota</p>
                        <p class="text-gray-900 font-mono">#{{ str_pad($anggotum->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('anggota.edit', $anggotum) }}" class="btn btn-primary flex-1 sm:flex-none">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Data
                </a>
                <a href="{{ route('anggota.index') }}" class="btn btn-outline flex-1 sm:flex-none">
                    <i class="fas fa-list mr-2"></i>
                    Daftar Anggota
                </a>
                <form action="{{ route('anggota.destroy', $anggotum) }}" 
                      method="POST" 
                      class="flex-1 sm:flex-none"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error w-full">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection