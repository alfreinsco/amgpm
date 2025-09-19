@extends('layouts.app')

@section('title', 'Dokumentasi Kegiatan')

@section('content')
<!-- Hero Section with Gradient Background -->
<div class="bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/30 to-purple-600/30"></div>

    <!-- Animated Background Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-pulse"></div>
    <div class="absolute top-32 right-20 w-16 h-16 bg-white/5 rounded-full animate-bounce"></div>
    <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white/10 rounded-full animate-ping"></div>

    <div class="container mx-auto px-4 py-16 relative z-10">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <div class="breadcrumbs text-sm text-white/80">
                <ul>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">
                        <i class="fas fa-home mr-1"></i>Dashboard
                    </a></li>
                    <li class="text-white font-medium">
                        <i class="fas fa-camera mr-1"></i>Dokumentasi Kegiatan
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Header Content -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <div class="flex-1">
                <div class="flex items-center mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 mr-4">
                        <i class="fas fa-camera text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold mb-2 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                            Dokumentasi Kegiatan
                        </h1>
                        <div class="flex items-center text-white/90">
                            <i class="fas fa-images mr-2"></i>
                            <span class="text-lg">Galeri foto dan dokumentasi kegiatan AMGPM</span>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="flex flex-wrap gap-4 mt-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2 border border-white/20">
                        <div class="flex items-center">
                            <i class="fas fa-photo-video mr-2 text-blue-200"></i>
                            <span class="text-sm font-medium">{{ $dokumentasi->total() }} Dokumentasi</span>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2 border border-white/20">
                        <div class="flex items-center">
                            <i class="fas fa-tags mr-2 text-purple-200"></i>
                            <span class="text-sm font-medium">{{ count($kategoris) }} Kategori</span>
                        </div>
                    </div>
                </div>
            </div>

            @if(auth()->user()->is_admin)
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('dokumentasi.create') }}"
                   class="btn bg-white text-blue-600 hover:bg-blue-50 border-0 shadow-lg hover:shadow-xl transition-all duration-300 group">
                    <i class="fas fa-plus mr-2 group-hover:rotate-90 transition-transform duration-300"></i>
                    Tambah Dokumentasi
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Wave Bottom -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden">
        <svg class="relative block w-full h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="white"></path>
        </svg>
    </div>
</div>

<div class="container mx-auto px-4 -mt-6 relative z-20">

    <!-- Filter dan Search -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 mb-8 overflow-hidden">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-blue-50 to-purple-50 px-6 py-4 border-b border-gray-100">
            <div class="flex items-center">
                <div class="bg-blue-100 rounded-lg p-2 mr-3">
                    <i class="fas fa-filter text-blue-600"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Filter & Pencarian</h3>
                    <p class="text-sm text-gray-600">Temukan dokumentasi yang Anda cari</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <form method="GET" action="{{ route('dokumentasi.index') }}" class="space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-{{ auth()->user()->is_admin ? '3' : '2' }} gap-6">
                    <!-- Search Input -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-search mr-2 text-blue-500"></i>
                            Cari Dokumentasi
                        </label>
                        <div class="relative">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Ketik judul dokumentasi..."
                                   class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            @if(request('search'))
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">
                                    Aktif
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-tags mr-2 text-purple-500"></i>
                            Kategori
                        </label>
                        <div class="relative">
                            <select name="kategori"
                                    class="w-full pl-12 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white appearance-none">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                    {{ ucfirst($kategori) }}
                                </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-tags text-gray-400"></i>
                            </div>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                            @if(request('kategori'))
                            <div class="absolute inset-y-0 right-10 pr-4 flex items-center">
                                <span class="bg-purple-100 text-purple-600 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst(request('kategori')) }}
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Status Filter (Admin Only) -->
                    @if(auth()->user()->is_admin)
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-toggle-on mr-2 text-green-500"></i>
                            Status Publikasi
                        </label>
                        <div class="relative">
                            <select name="status"
                                    class="w-full pl-12 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white appearance-none">
                                <option value="">Semua Status</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                                    Published
                                </option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>
                                    Draft
                                </option>
                            </select>
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-toggle-on text-gray-400"></i>
                            </div>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                            @if(request('status'))
                            <div class="absolute inset-y-0 right-10 pr-4 flex items-center">
                                <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">
                                    {{ request('status') == 'published' ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t border-gray-100">
                    <div class="text-sm text-gray-500">
                        @if(request('search') || request('kategori') || request('status'))
                            <i class="fas fa-info-circle mr-1"></i>
                            Filter aktif - {{ $dokumentasi->total() }} hasil ditemukan
                            @if(auth()->user()->is_admin)
                                (termasuk draft)
                            @endif
                        @else
                            <i class="fas fa-database mr-1"></i>
                            @if(auth()->user()->is_admin)
                                Menampilkan semua {{ $dokumentasi->total() }} dokumentasi (termasuk draft)
                            @else
                                Menampilkan semua {{ $dokumentasi->total() }} dokumentasi
                            @endif
                        @endif
                    </div>

                    <div class="flex gap-3">
                        @if(request('search') || request('kategori') || request('status'))
                        <a href="{{ route('dokumentasi.index') }}"
                           class="btn bg-gray-100 text-gray-600 hover:bg-gray-200 border-0 transition-all duration-200 group">
                            <i class="fas fa-times mr-2 group-hover:rotate-90 transition-transform duration-200"></i>
                            Reset Filter
                        </a>
                        @endif

                        <button type="submit"
                                class="btn bg-gradient-to-r from-blue-500 to-purple-600 text-white hover:from-blue-600 hover:to-purple-700 border-0 shadow-lg hover:shadow-xl transition-all duration-200 group">
                            <i class="fas fa-search mr-2 group-hover:scale-110 transition-transform duration-200"></i>
                            Cari Dokumentasi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Dokumentasi Grid -->
    @if($dokumentasi->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @foreach($dokumentasi as $doc)
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-blue-200 transform hover:-translate-y-2 relative">
            <!-- Image Container -->
            <div class="relative overflow-hidden rounded-t-2xl">
                @if($doc->foto_kegiatan && count($doc->foto_kegiatan) > 0)
                <div class="aspect-w-16 aspect-h-10 bg-gradient-to-br from-blue-50 to-purple-50">
                    <img src="{{ asset('storage/' . $doc->foto_kegiatan[0]) }}"
                         alt="{{ $doc->judul }}"
                         class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                @else
                <div class="h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-image text-gray-400 text-4xl mb-2"></i>
                        <p class="text-gray-500 text-sm">Tidak ada foto</p>
                    </div>
                </div>
                @endif

                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-4 left-4 right-4">
                        <div class="flex items-center justify-between">
                            @if($doc->foto_kegiatan && count($doc->foto_kegiatan) > 1)
                            <div class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 text-white text-xs font-medium">
                                <i class="fas fa-images mr-1"></i>
                                {{ count($doc->foto_kegiatan) }} foto
                            </div>
                            @endif
                            <div class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 text-white text-xs">
                                {{ $doc->tanggal_kegiatan_formatted }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Badge -->
                <div class="absolute top-4 left-4 flex flex-col gap-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                        {{ $doc->kategori == 'ibadah' ? 'bg-blue-100 text-blue-800 border border-blue-200' : 
                           ($doc->kategori == 'sosial' ? 'bg-green-100 text-green-800 border border-green-200' : 
                            'bg-purple-100 text-purple-800 border border-purple-200') }}">
                        <i class="fas fa-tag mr-1"></i>
                        {{ ucfirst($doc->kategori) }}
                    </span>
                    
                    @if(auth()->user()->is_admin)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                        {{ $doc->is_published ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-yellow-100 text-yellow-800 border border-yellow-200' }}">
                        <div class="w-2 h-2 rounded-full mr-1 {{ $doc->is_published ? 'bg-green-500' : 'bg-yellow-500' }}"></div>
                        {{ $doc->is_published ? 'Published' : 'Draft' }}
                    </span>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Title -->
                <h3 class="font-bold text-xl text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                    {{ $doc->judul }}
                </h3>

                <!-- Location -->
                @if($doc->lokasi)
                <div class="flex items-center text-gray-600 mb-3">
                    <div class="bg-gray-100 rounded-lg p-2 mr-3">
                        <i class="fas fa-map-marker-alt text-gray-500 text-sm"></i>
                    </div>
                    <span class="text-sm font-medium">{{ $doc->lokasi }}</span>
                </div>
                @endif

                <!-- Description -->
                <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                    {{ Str::limit($doc->deskripsi, 120) }}
                </p>

                <!-- Meta Info -->
                <div class="flex items-center justify-between mb-6 pt-4 border-t border-gray-100">
                    <div class="flex items-center">
                        <div class="bg-blue-100 rounded-full p-2 mr-3">
                            <i class="fas fa-user text-blue-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Dibuat oleh</p>
                            <p class="text-sm font-medium text-gray-700">{{ $doc->creator->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('dokumentasi.show', $doc) }}"
                       class="flex-1 mr-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2.5 rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all duration-200 text-center text-sm font-medium group/btn">
                        <i class="fas fa-eye mr-2 group-hover/btn:scale-110 transition-transform duration-200"></i>
                        Lihat Detail
                    </a>

                    @if(auth()->user()->is_admin)
                    <div class="dropdown dropdown-end relative z-50">
                        <label tabindex="0" class="btn btn-ghost btn-sm bg-gray-100 hover:bg-gray-200 rounded-xl border-0">
                            <i class="fas fa-ellipsis-v text-gray-600"></i>
                        </label>
                        <ul tabindex="0" class="dropdown-content menu p-2 shadow-2xl bg-white rounded-xl w-48 border border-gray-100 z-[9999] mt-2">
                            <li>
                                <a href="{{ route('dokumentasi.edit', $doc) }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                                    <i class="fas fa-edit"></i>
                                    Edit Dokumentasi
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('dokumentasi.destroy', $doc) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus dokumentasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:bg-red-50 rounded-lg w-full text-left">
                                        <i class="fas fa-trash"></i>
                                        Hapus Dokumentasi
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mb-8">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-4">
            {{ $dokumentasi->links() }}
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-50 to-purple-50 px-6 py-8">
            <div class="text-center">
                <!-- Icon -->
                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-camera text-3xl text-gray-400"></i>
                </div>

                <!-- Title -->
                <h3 class="text-2xl font-bold text-gray-800 mb-3">
                    @if(request('search') || request('kategori'))
                        Tidak Ada Hasil Ditemukan
                    @else
                        Belum Ada Dokumentasi
                    @endif
                </h3>

                <!-- Description -->
                <p class="text-gray-600 mb-8 max-w-md mx-auto leading-relaxed">
                    @if(request('search') || request('kategori'))
                        Tidak ada dokumentasi yang sesuai dengan filter pencarian Anda. Coba ubah kata kunci atau kategori pencarian.
                    @else
                        Belum ada dokumentasi kegiatan yang ditambahkan. Mulai dokumentasikan kegiatan AMGPM Anda sekarang!
                    @endif
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @if(request('search') || request('kategori'))
                    <a href="{{ route('dokumentasi.index') }}"
                       class="btn bg-gradient-to-r from-gray-500 to-gray-600 text-white hover:from-gray-600 hover:to-gray-700 border-0 shadow-lg hover:shadow-xl transition-all duration-200 group">
                        <i class="fas fa-refresh mr-2 group-hover:rotate-180 transition-transform duration-300"></i>
                        Lihat Semua Dokumentasi
                    </a>
                    @endif

                    @if(auth()->user()->is_admin)
                    <a href="{{ route('dokumentasi.create') }}"
                       class="btn bg-gradient-to-r from-blue-500 to-purple-600 text-white hover:from-blue-600 hover:to-purple-700 border-0 shadow-lg hover:shadow-xl transition-all duration-200 group">
                        <i class="fas fa-plus mr-2 group-hover:rotate-90 transition-transform duration-300"></i>
                        @if(request('search') || request('kategori'))
                            Tambah Dokumentasi Baru
                        @else
                            Tambah Dokumentasi Pertama
                        @endif
                    </a>
                    @endif
                </div>

                <!-- Tips -->
                @if(!request('search') && !request('kategori') && auth()->user()->is_admin)
                <div class="mt-8 bg-white/50 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="flex items-start">
                        <div class="bg-blue-100 rounded-lg p-2 mr-3 flex-shrink-0">
                            <i class="fas fa-lightbulb text-blue-600"></i>
                        </div>
                        <div class="text-left">
                            <h4 class="font-semibold text-gray-800 mb-1">Tips Dokumentasi</h4>
                            <p class="text-sm text-gray-600">
                                Dokumentasikan setiap kegiatan AMGPM dengan foto berkualitas dan deskripsi yang menarik untuk berbagi momen berharga dengan jemaat.
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

@if(session('success'))
<div class="toast toast-top toast-end">
    <div class="alert alert-success">
        <div>
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Custom scrollbar for better aesthetics */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #2563eb, #7c3aed);
}

/* Enhanced animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

/* Improved focus states */
.focus-ring:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    border-color: #3b82f6;
}

/* Toast notification improvements */
.toast {
    z-index: 9999;
}

.toast .alert {
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add fade-in animation to cards
    const cards = document.querySelectorAll('.group');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate-fade-in-up');
    });

    // Enhanced search input focus
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-blue-500');
        });

        searchInput.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-blue-500');
        });
    }

    // Auto-hide toast notifications
    const toasts = document.querySelectorAll('.toast .alert');
    toasts.forEach(toast => {
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 5000);
    });

    // Smooth scroll for pagination
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const heroSection = document.querySelector('.bg-gradient-to-br');
            if (heroSection) {
                setTimeout(() => {
                    heroSection.scrollIntoView({ behavior: 'smooth' });
                }, 100);
            }
        });
    });
});
</script>
@endpush
