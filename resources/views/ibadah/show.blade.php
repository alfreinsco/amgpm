@extends('layouts.app')

@section('title', $ibadah->nama . ' - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200">
            <div>
                <h1 class="text-3xl font-extrabold text-blue-900">{{ $ibadah->nama }}</h1>
                <p class="mt-2 text-sm text-gray-500">Detail jadwal ibadah AMGPM Ranting Parthenos.</p>
            </div>
            <a href="{{ route('ibadah.index') }}" class="btn btn-ghost text-gray-600 hover:bg-gray-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        @if (session('success'))
            <div role="alert" class="alert alert-success mb-6 rounded-lg border-l-4 border-green-500 bg-green-50 text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white p-8 md:p-12 rounded-2xl shadow-2xl border border-gray-100">
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-6">
                        <div class="bg-blue-100 text-blue-600 rounded-full w-16 h-16 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-church text-3xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $ibadah->nama }}</h2>
                            @if($ibadah->tema)
                                <p class="text-lg text-gray-500 mt-1">{{ $ibadah->tema }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="space-y-4">
                            <h3 class="font-semibold text-lg text-gray-800 border-b border-gray-200 pb-2 mb-4">
                                Waktu & Tempat
                            </h3>

                            <div class="space-y-3 text-gray-600">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-calendar text-blue-500 w-5 h-5"></i>
                                    <span>{{ $ibadah->tanggal_formatted }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-clock text-blue-500 w-5 h-5"></i>
                                    <span>{{ $ibadah->waktu_formatted }} WIB</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-map-marker-alt text-blue-500 w-5 h-5"></i>
                                    <span>{{ $ibadah->lokasi }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="font-semibold text-lg text-gray-800 border-b border-gray-200 pb-2 mb-4">
                                Petugas
                            </h3>

                            <div class="space-y-3 text-gray-600">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-user-tie text-blue-500 w-5 h-5"></i>
                                    <span>{{ $ibadah->pemimpin }} (Pemimpin Ibadah)</span>
                                </div>
                                @if($ibadah->pemandu)
                                    <div class="flex items-center gap-3">
                                        <i class="fas fa-microphone text-blue-500 w-5 h-5"></i>
                                        <span>{{ $ibadah->pemandu }} (Pemandu Ibadah)</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($ibadah->catatan)
                            <div class="md:col-span-2">
                                <h3 class="font-semibold text-lg text-gray-800 border-b border-gray-200 pb-2 mb-4">
                                    Catatan
                                </h3>
                                <div class="bg-gray-100 rounded-lg p-4">
                                    <p class="text-gray-700 leading-relaxed">{{ $ibadah->catatan }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">
                        Informasi
                    </h3>

                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between items-center">
                            <span>Status:</span>
                            @if($ibadah->tanggal->isPast())
                                <span class="badge badge-neutral text-xs">Selesai</span>
                            @elseif($ibadah->tanggal->isToday())
                                <span class="badge badge-warning text-xs">Hari Ini</span>
                            @else
                                <span class="badge bg-green-500 text-white text-xs border-none">Akan Datang</span>
                            @endif
                        </div>

                        <div class="flex justify-between items-center">
                            <span>Dibuat oleh:</span>
                            <span class="font-medium text-right">{{ $ibadah->user->nama ?? 'System' }}</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span>Dibuat pada:</span>
                            <span class="text-right">{{ $ibadah->created_at->format('d F Y') }}</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span>Terakhir diperbarui:</span>
                            <span class="text-right">{{ $ibadah->updated_at->format('d F Y') }}</span>
                        </div>
                    </div>
                </div>

                @if(Auth::check() && Auth::user()->is_admin)
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                            Aksi Admin
                        </h3>

                        <div class="space-y-2">
                            <a href="{{ route('ibadah.edit', $ibadah) }}" class="btn btn-warning w-full">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Jadwal
                            </a>

                            <form action="{{ route('ibadah.destroy', $ibadah) }}" method="POST" class="w-full"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ibadah ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error w-full">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus Jadwal
                                </button>
                            </form>

                            <a href="{{ route('ibadah.create') }}" class="btn bg-blue-600 text-white hover:bg-blue-700 w-full">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Jadwal Baru
                            </a>
                        </div>
                    </div>
                @endif

                @if($ibadah->tanggal->isFuture())
                    <div class="bg-blue-600 text-white p-6 rounded-xl shadow-lg text-center">
                        <h3 class="font-semibold text-lg mb-2">
                            <i class="fas fa-hourglass-half mr-2"></i>
                            Countdown
                        </h3>
                        <p class="text-3xl font-bold">
                            {{ $ibadah->tanggal->diffForHumans() }}
                        </p>
                        <p class="text-sm opacity-90">hingga ibadah dimulai</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
