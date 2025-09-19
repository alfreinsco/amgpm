@extends('layouts.app')

@section('title', $dokumentasi->judul)

@section('content')
<!-- Hero Section with Gradient Background -->
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-200/30 to-purple-200/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-indigo-200/30 to-pink-200/30 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="relative container mx-auto px-4 py-8">
        <!-- Breadcrumb & Header -->
        <div class="mb-8">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">
                    <i class="fas fa-home"></i>
                </a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <a href="{{ route('dokumentasi.index') }}" class="hover:text-blue-600 transition-colors">
                    Dokumentasi
                </a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <span class="text-gray-800 font-medium">{{ Str::limit($dokumentasi->judul, 30) }}</span>
            </nav>

            <!-- Header with Animation -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center mb-4">
                            <a href="{{ route('dokumentasi.index') }}"
                               class="btn btn-ghost btn-circle mr-4 hover:bg-blue-100 transition-all duration-300">
                                <i class="fas fa-arrow-left text-blue-600"></i>
                            </a>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-camera text-white text-xl"></i>
                                </div>
                                <div>
                                    <div class="badge badge-{{ $dokumentasi->kategori == 'ibadah' ? 'primary' : ($dokumentasi->kategori == 'sosial' ? 'secondary' : 'accent') }} mb-2">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ ucfirst($dokumentasi->kategori) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-4">
                            {{ $dokumentasi->judul }}
                        </h1>

                        <div class="flex flex-wrap items-center gap-6 text-gray-600">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-calendar text-blue-600 text-sm"></i>
                                </div>
                                <span class="font-medium">{{ $dokumentasi->tanggal_kegiatan_formatted }}</span>
                            </div>

                            @if($dokumentasi->lokasi)
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-map-marker-alt text-green-600 text-sm"></i>
                                </div>
                                <span class="font-medium">{{ $dokumentasi->lokasi }}</span>
                            </div>
                            @endif

                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-user text-purple-600 text-sm"></i>
                                </div>
                                <span class="font-medium">{{ $dokumentasi->creator->name }}</span>
                            </div>

                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-images text-orange-600 text-sm"></i>
                                </div>
                                <span class="font-medium">{{ count($dokumentasi->foto_kegiatan ?? []) }} foto</span>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->is_admin)
                    <div class="flex gap-3">
                        <a href="{{ route('dokumentasi.edit', $dokumentasi) }}"
                           class="btn btn-primary bg-gradient-to-r from-blue-500 to-purple-600 border-none hover:from-blue-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-edit mr-2"></i>
                            Edit
                        </a>

                        <div class="dropdown dropdown-end">
                            <label tabindex="0" class="btn btn-outline hover:bg-red-50 hover:border-red-300 hover:text-red-600 transition-all duration-300">
                                <i class="fas fa-ellipsis-v"></i>
                            </label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow-xl bg-white rounded-xl border border-gray-200 w-52">
                                <li>
                                    <form action="{{ route('dokumentasi.destroy', $dokumentasi) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus dokumentasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:bg-red-50 w-full text-left transition-colors">
                                            <i class="fas fa-trash mr-2"></i>
                                            Hapus Dokumentasi
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Photo Gallery & Description -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Photo Gallery -->
                @if($dokumentasi->foto_kegiatan && count($dokumentasi->foto_kegiatan) > 0)
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-images text-white"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800">Galeri Foto</h2>
                                    <p class="text-gray-600">{{ count($dokumentasi->foto_kegiatan) }} foto tersedia</p>
                                </div>
                            </div>
                            <div class="badge badge-primary badge-lg">
                                <i class="fas fa-camera mr-1"></i>
                                {{ count($dokumentasi->foto_kegiatan) }}
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Main Photo Display -->
                        <div class="relative mb-6 group">
                            <div class="aspect-video rounded-xl overflow-hidden bg-gray-100 shadow-lg">
                                <img id="main-photo"
                                     src="{{ asset('storage/' . $dokumentasi->foto_kegiatan[0]) }}"
                                     alt="{{ $dokumentasi->judul }}"
                                     class="w-full h-full object-cover cursor-pointer transition-transform duration-500 group-hover:scale-105"
                                     onclick="openPhotoModal(this.src)">
                            </div>

                            <!-- Photo Navigation Overlay -->
                            <div class="absolute inset-0 flex items-center justify-between p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                @if(count($dokumentasi->foto_kegiatan) > 1)
                                <button onclick="previousPhoto()" class="btn btn-circle btn-primary bg-white/20 backdrop-blur-sm border-white/30 hover:bg-white/30">
                                    <i class="fas fa-chevron-left text-white"></i>
                                </button>
                                <button onclick="nextPhoto()" class="btn btn-circle btn-primary bg-white/20 backdrop-blur-sm border-white/30 hover:bg-white/30">
                                    <i class="fas fa-chevron-right text-white"></i>
                                </button>
                                @endif
                            </div>

                            <!-- Photo Counter -->
                            <div class="absolute bottom-4 right-4 bg-black/50 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">
                                <span id="photo-counter">1</span> / {{ count($dokumentasi->foto_kegiatan) }}
                            </div>

                            <!-- Fullscreen Button -->
                            <button onclick="openPhotoModal(document.getElementById('main-photo').src)"
                                    class="absolute top-4 right-4 btn btn-circle btn-sm bg-black/50 backdrop-blur-sm border-white/30 hover:bg-black/70 text-white">
                                <i class="fas fa-expand"></i>
                            </button>
                        </div>


                    </div>
                </div>
                @endif

                <!-- Description Section -->
                @if($dokumentasi->deskripsi)
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-align-left text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Deskripsi Kegiatan</h2>
                                <p class="text-gray-600">Detail lengkap tentang kegiatan ini</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($dokumentasi->deskripsi)) !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column - Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Info Card -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-info-circle text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Informasi Detail</h3>
                                <p class="text-gray-600">Data lengkap kegiatan</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="group hover:bg-gray-50/50 p-3 rounded-xl transition-colors duration-300">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center mr-3 mt-1">
                                    <i class="fas fa-tag text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-500 mb-1">Kategori</div>
                                    <div class="font-semibold text-gray-800">{{ ucfirst($dokumentasi->kategori) }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="group hover:bg-gray-50/50 p-3 rounded-xl transition-colors duration-300">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mr-3 mt-1">
                                    <i class="fas fa-eye text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-500 mb-1">Status Publikasi</div>
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $dokumentasi->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        <div class="w-2 h-2 rounded-full mr-2 {{ $dokumentasi->is_published ? 'bg-green-500' : 'bg-yellow-500' }}"></div>
                                        {{ $dokumentasi->is_published ? 'Dipublikasikan' : 'Draft' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="group hover:bg-gray-50/50 p-3 rounded-xl transition-colors duration-300">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg flex items-center justify-center mr-3 mt-1">
                                    <i class="fas fa-calendar-plus text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-500 mb-1">Tanggal Dibuat</div>
                                    <div class="font-semibold text-gray-800">{{ $dokumentasi->created_at->format('d M Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $dokumentasi->created_at->format('H:i') }} WIB</div>
                                </div>
                            </div>
                        </div>

                        @if($dokumentasi->updated_at != $dokumentasi->created_at)
                        <div class="group hover:bg-gray-50/50 p-3 rounded-xl transition-colors duration-300">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center mr-3 mt-1">
                                    <i class="fas fa-calendar-edit text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-500 mb-1">Terakhir Diperbarui</div>
                                    <div class="font-semibold text-gray-800">{{ $dokumentasi->updated_at->format('d M Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $dokumentasi->updated_at->format('H:i') }} WIB</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($dokumentasi->foto_kegiatan)
                        <div class="group hover:bg-gray-50/50 p-3 rounded-xl transition-colors duration-300">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-gradient-to-br from-pink-500 to-rose-600 rounded-lg flex items-center justify-center mr-3 mt-1">
                                    <i class="fas fa-images text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-500 mb-1">Total Foto</div>
                                    <div class="font-semibold text-gray-800">{{ count($dokumentasi->foto_kegiatan) }} foto tersimpan</div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Share Card -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-share-alt text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Bagikan Kegiatan</h3>
                                <p class="text-gray-600">Sebarkan informasi ini</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <button onclick="copyToClipboard()" class="w-full group relative overflow-hidden bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                            <div class="relative flex items-center justify-center">
                                <i class="fas fa-copy mr-2"></i>
                                Salin Link
                            </div>
                        </button>

                        <button onclick="shareWhatsApp()" class="w-full group relative overflow-hidden bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                            <div class="relative flex items-center justify-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Share ke WhatsApp
                            </div>
                        </button>

                        <div class="pt-4 border-t border-gray-200">
                            <div class="text-center text-sm text-gray-500">
                                <i class="fas fa-heart text-red-500 mr-1"></i>
                                Bagikan untuk menginspirasi yang lain
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<!-- Photo Modal -->
<div id="photo-modal" class="fixed inset-0 bg-black/90 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="relative max-w-7xl max-h-full">
        <!-- Close Button -->
        <button onclick="closePhotoModal()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors duration-300 z-10">
            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300">
                <i class="fas fa-times text-xl"></i>
            </div>
        </button>

        <!-- Download Button -->
        <button onclick="downloadPhoto()" class="absolute -top-12 right-14 text-white hover:text-gray-300 transition-colors duration-300 z-10">
            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300">
                <i class="fas fa-download text-lg"></i>
            </div>
        </button>

        <!-- Modal Image -->
        <div class="relative">
            <img id="modal-photo" src="" alt="" class="max-w-full max-h-[90vh] object-contain rounded-xl shadow-2xl">

            <!-- Navigation Arrows -->
            @if($dokumentasi->foto_kegiatan && count($dokumentasi->foto_kegiatan) > 1)
            <button onclick="previousPhotoModal()" class="absolute left-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300 text-white">
                <i class="fas fa-chevron-left text-xl"></i>
            </button>
            <button onclick="nextPhotoModal()" class="absolute right-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300 text-white">
                <i class="fas fa-chevron-right text-xl"></i>
            </button>
            @endif

            <!-- Photo Info -->
            <div class="absolute bottom-4 left-4 bg-black/50 backdrop-blur-sm text-white px-4 py-2 rounded-lg">
                <div class="text-sm font-medium">{{ $dokumentasi->judul }}</div>
                <div class="text-xs opacity-75">Foto <span id="modal-photo-counter">1</span> dari {{ count($dokumentasi->foto_kegiatan ?? []) }}</div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div id="success-toast" class="fixed top-4 right-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-2xl z-50 transform translate-x-full transition-transform duration-500 border border-white/20">
    <div class="flex items-center">
        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
            <i class="fas fa-check text-sm"></i>
        </div>
        <div>
            <div class="font-semibold">Berhasil!</div>
            <div class="text-sm opacity-90">{{ session('success') }}</div>
        </div>
        <button onclick="hideToast()" class="ml-4 text-white/70 hover:text-white transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
let currentPhotoIndex = 0;
const photos = @json($dokumentasi->foto_kegiatan ?? []);
let modalCurrentIndex = 0;

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Show success toast if exists
    const toast = document.getElementById('success-toast');
    if (toast) {
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        // Auto hide after 5 seconds
        setTimeout(() => {
            hideToast();
        }, 5000);
    }

    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';

    // Add keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('photo-modal');
        if (!modal.classList.contains('hidden')) {
            if (e.key === 'Escape') {
                closePhotoModal();
            } else if (e.key === 'ArrowLeft') {
                previousPhotoModal();
            } else if (e.key === 'ArrowRight') {
                nextPhotoModal();
            }
        }
    });
});

// Photo gallery functions
function changeMainPhoto(thumbnail, index) {
    // Update main photo with smooth transition
    const mainPhoto = document.getElementById('main-photo');
    mainPhoto.style.opacity = '0.5';

    setTimeout(() => {
        mainPhoto.src = thumbnail.src;
        mainPhoto.style.opacity = '1';
        currentPhotoIndex = index;
        document.getElementById('photo-counter').textContent = index + 1;
    }, 150);
}

function previousPhoto() {
    if (photos.length <= 1) return;

    currentPhotoIndex = currentPhotoIndex > 0 ? currentPhotoIndex - 1 : photos.length - 1;
    const mainPhoto = document.getElementById('main-photo');
    if (mainPhoto && photos[currentPhotoIndex]) {
        mainPhoto.style.opacity = '0.5';
        setTimeout(() => {
            mainPhoto.src = "{{ asset('storage/') }}/" + photos[currentPhotoIndex];
            mainPhoto.style.opacity = '1';
            document.getElementById('photo-counter').textContent = currentPhotoIndex + 1;
        }, 150);
    }
}

function nextPhoto() {
    if (photos.length <= 1) return;

    currentPhotoIndex = currentPhotoIndex < photos.length - 1 ? currentPhotoIndex + 1 : 0;
    const mainPhoto = document.getElementById('main-photo');
    if (mainPhoto && photos[currentPhotoIndex]) {
        mainPhoto.style.opacity = '0.5';
        setTimeout(() => {
            mainPhoto.src = "{{ asset('storage/') }}/" + photos[currentPhotoIndex];
            mainPhoto.style.opacity = '1';
            document.getElementById('photo-counter').textContent = currentPhotoIndex + 1;
        }, 150);
    }
}

// Modal functions
function openPhotoModal(src) {
    const modal = document.getElementById('photo-modal');
    const modalPhoto = document.getElementById('modal-photo');

    modalPhoto.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // Find current photo index for modal
    modalCurrentIndex = photos.findIndex(photo => src.includes(photo));
    if (modalCurrentIndex === -1) modalCurrentIndex = 0;

    updateModalCounter();

    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closePhotoModal() {
    const modal = document.getElementById('photo-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');

    // Restore body scroll
    document.body.style.overflow = 'auto';
}

function previousPhotoModal() {
    if (photos.length <= 1) return;

    modalCurrentIndex = modalCurrentIndex > 0 ? modalCurrentIndex - 1 : photos.length - 1;
    const modalPhoto = document.getElementById('modal-photo');
    modalPhoto.src = "{{ asset('storage/') }}/" + photos[modalCurrentIndex];
    updateModalCounter();
}

function nextPhotoModal() {
    if (photos.length <= 1) return;

    modalCurrentIndex = modalCurrentIndex < photos.length - 1 ? modalCurrentIndex + 1 : 0;
    const modalPhoto = document.getElementById('modal-photo');
    modalPhoto.src = "{{ asset('storage/') }}/" + photos[modalCurrentIndex];
    updateModalCounter();
}

function updateModalCounter() {
    const counter = document.getElementById('modal-photo-counter');
    if (counter) {
        counter.textContent = modalCurrentIndex + 1;
    }
}

function downloadPhoto() {
    const modalPhoto = document.getElementById('modal-photo');
    const link = document.createElement('a');
    link.href = modalPhoto.src;
    link.download = `{{ $dokumentasi->judul }}_foto_${modalCurrentIndex + 1}.jpg`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    // Show download feedback
    showToast('Foto berhasil diunduh!', 'success');
}

// Share functions
function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        showToast('Link berhasil disalin ke clipboard!', 'success');
    }).catch(() => {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        showToast('Link berhasil disalin!', 'success');
    });
}

function shareWhatsApp() {
    const url = window.location.href;
    const text = `Lihat dokumentasi kegiatan: {{ $dokumentasi->judul }}`;
    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`;
    window.open(whatsappUrl, '_blank');
}

// Toast functions
function showToast(message, type = 'success') {
    // Remove existing toast
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) {
        existingToast.remove();
    }

    const toast = document.createElement('div');
    toast.className = `toast-notification fixed top-4 right-4 px-6 py-4 rounded-xl shadow-2xl z-50 transform translate-x-full transition-transform duration-500 border border-white/20 ${
        type === 'success' ? 'bg-gradient-to-r from-green-500 to-emerald-600 text-white' :
        'bg-gradient-to-r from-red-500 to-rose-600 text-white'
    }`;

    toast.innerHTML = `
        <div class="flex items-center">
            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-${type === 'success' ? 'check' : 'exclamation-triangle'} text-sm"></i>
            </div>
            <div>
                <div class="font-semibold">${type === 'success' ? 'Berhasil!' : 'Perhatian!'}</div>
                <div class="text-sm opacity-90">${message}</div>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white/70 hover:text-white transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);

    setTimeout(() => {
        if (toast.parentElement) {
            toast.classList.add('translate-x-full');
            setTimeout(() => toast.remove(), 500);
        }
    }, 4000);
}

function hideToast() {
    const toast = document.getElementById('success-toast');
    if (toast) {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 500);
    }
}

// Backward compatibility
function copyToClipboard() {
    copyLink();
}
</script>
@endpush
