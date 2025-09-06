@extends('layouts.app')

@section('title', 'Jadwal Ibadah - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200">
            <div>
                <h1 class="text-3xl font-extrabold text-blue-900">Jadwal Ibadah</h1>
                <p class="mt-2 text-sm text-gray-500">Kelola jadwal ibadah AMGPM Ranting Parthenos</p>
            </div>
            @if(Auth::check() && Auth::user()->is_admin)
                <a href="{{ route('ibadah.create') }}" class="btn bg-blue-600 text-white hover:bg-blue-700 shadow-md">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Jadwal
                </a>
            @endif
        </div>

        @if (session('success'))
            <div role="alert" class="alert alert-success mb-6 rounded-lg border-l-4 border-green-500 bg-green-50 text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Search and Filter Form -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
            <form method="GET" action="{{ route('ibadah.index') }}" class="space-y-4">
                <div class="flex flex-col lg:flex-row gap-4">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-search mr-1"></i>
                            Cari Ibadah
                        </label>
                        <input type="text"
                               id="search"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari berdasarkan nama, lokasi, pemimpin, pemandu, atau catatan..."
                               class="input input-bordered w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Date Range Filter -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                Dari Tanggal
                            </label>
                            <input type="date"
                                   id="start_date"
                                   name="start_date"
                                   value="{{ request('start_date') }}"
                                   class="input input-bordered focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                Sampai Tanggal
                            </label>
                            <input type="date"
                                   id="end_date"
                                   name="end_date"
                                   value="{{ request('end_date') }}"
                                   class="input input-bordered focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-2 pt-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                    <a href="{{ route('ibadah.index') }}" class="btn btn-outline">
                        <i class="fas fa-times mr-2"></i>
                        Reset
                    </a>
                </div>
            </form>
        </div>

        @if($ibadah->count() > 0)
            <div class="grid gap-6">
                @foreach($ibadah as $item)
                    <div class="bg-white p-6 rounded-lg shadow-xl border border-gray-100 transition-transform transform hover:scale-[1.01]">
                        <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                            <div class="flex-1 space-y-2">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="bg-blue-100 text-blue-600 rounded-full w-10 h-10 flex items-center justify-center">
                                        <i class="fas fa-church text-lg"></i>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">{{ $item->nama }}</h2>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-calendar text-blue-500"></i>
                                        <span>{{ $item->tanggal_formatted }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-clock text-blue-500"></i>
                                        <span>{{ $item->waktu_formatted }} WIB</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-map-marker-alt text-blue-500"></i>
                                        <span>{{ $item->lokasi }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-user-tie text-blue-500"></i>
                                        <span>{{ $item->pemimpin }}</span>
                                    </div>
                                    @if($item->pemandu)
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-microphone text-blue-500"></i>
                                        <span>{{ $item->pemandu }}</span>
                                    </div>
                                    @endif
                                    @if($item->catatan)
                                        <div class="flex items-start gap-2 sm:col-span-2 mt-2">
                                            <i class="fas fa-sticky-note text-blue-500 mt-1"></i>
                                            <p class="text-gray-500 italic">{{ $item->catatan }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-row sm:flex-col gap-2 mt-4 sm:mt-0">
                                <a href="{{ route('ibadah.show', $item) }}" class="btn btn-sm text-white bg-blue-500 hover:bg-blue-600 border-none">
                                    <i class="fas fa-eye"></i>
                                    <span class="hidden sm:inline ml-1">Detail</span>
                                </a>
                                @if(Auth::check() && Auth::user()->is_admin)
                                    <a href="{{ route('ibadah.edit', $item) }}" class="btn btn-sm text-white bg-yellow-500 hover:bg-yellow-600 border-none">
                                        <i class="fas fa-edit"></i>
                                        <span class="hidden sm:inline ml-1">Edit</span>
                                    </a>
                                    <form action="{{ route('ibadah.destroy', $item) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ibadah ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-white bg-red-500 hover:bg-red-600 border-none">
                                            <i class="fas fa-trash"></i>
                                            <span class="hidden sm:inline ml-1">Hapus</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center text-xs text-gray-400">
                            <span>Dibuat oleh: {{ $item->user->nama ?? 'System' }}</span>
                            <span>{{ $item->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-center">
                <div class="join">
                    {{-- Previous Page Link --}}
                    @if ($ibadah->onFirstPage())
                        <button class="join-item btn btn-disabled">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    @else
                        <a href="{{ $ibadah->previousPageUrl() }}" class="join-item btn btn-outline">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($ibadah->getUrlRange(1, $ibadah->lastPage()) as $page => $url)
                        @if ($page == $ibadah->currentPage())
                            <button class="join-item btn btn-active">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="join-item btn btn-outline">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($ibadah->hasMorePages())
                        <a href="{{ $ibadah->nextPageUrl() }}" class="join-item btn btn-outline">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <button class="join-item btn btn-disabled">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        @else
            <div class="bg-white p-12 rounded-lg shadow-xl text-center border border-gray-100">
                <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-church text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Belum Ada Jadwal Ibadah</h3>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan jadwal ibadah pertama Anda.</p>
                @if(Auth::check() && Auth::user()->is_admin)
                    <a href="{{ route('ibadah.create') }}" class="btn bg-blue-600 text-white hover:bg-blue-700 shadow-md">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Jadwal Pertama
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
