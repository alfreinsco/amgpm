@extends('layouts.app')

@section('title', 'Tambah Dokumentasi Kegiatan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Animated Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4 shadow-lg animate-pulse">
                <i class="fas fa-camera text-white text-2xl"></i>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                Tambah Dokumentasi Kegiatan
            </h1>
            <p class="text-gray-600 text-lg">Abadikan momen berharga kegiatan AMGPM</p>

            <!-- Breadcrumb -->
            <div class="flex items-center justify-center mt-4 text-sm">
                <a href="{{ route('dokumentasi.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                    <i class="fas fa-home mr-1"></i>Dokumentasi
                </a>
                <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                <span class="text-gray-600">Tambah Baru</span>
            </div>
        </div>

        <!-- Form -->
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-edit text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Form Dokumentasi</h2>
                                <p class="text-blue-100">Lengkapi informasi kegiatan dengan detail</p>
                            </div>
                        </div>
                        <a href="{{ route('dokumentasi.index') }}" class="btn btn-ghost text-white hover:bg-white hover:bg-opacity-20 border-white border-opacity-30">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>

                <div class="p-8">
                    <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Section Title -->
                                <div class="flex items-center mb-6">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-info-circle text-blue-600"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-800">Informasi Kegiatan</h3>
                                </div>

                                <!-- Judul -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-heading mr-2 text-blue-500"></i>
                                            Judul Kegiatan <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <input type="text" name="judul" value="{{ old('judul') }}"
                                           placeholder="Contoh: Retreat Pemuda AMGPM 2024..."
                                           class="input input-bordered input-lg focus:input-primary transition-all duration-300 @error('judul') input-error @enderror" required>
                                    @error('judul')
                                    <label class="label">
                                        <span class="label-text-alt text-red-500 flex items-center">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                        </span>
                                    </label>
                                    @enderror
                                </div>

                                <!-- Tanggal Kegiatan -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-calendar-alt mr-2 text-green-500"></i>
                                            Tanggal Kegiatan <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}"
                                           class="input input-bordered input-lg focus:input-primary transition-all duration-300 @error('tanggal_kegiatan') input-error @enderror" required>
                                    @error('tanggal_kegiatan')
                                    <label class="label">
                                        <span class="label-text-alt text-red-500 flex items-center">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                        </span>
                                    </label>
                                    @enderror
                                </div>

                                <!-- Lokasi -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                                            Lokasi Kegiatan
                                        </span>
                                    </label>
                                    <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                                           placeholder="Contoh: Gereja GPM Silo, Ambon..."
                                           class="input input-bordered input-lg focus:input-primary transition-all duration-300 @error('lokasi') input-error @enderror">
                                    @error('lokasi')
                                    <label class="label">
                                        <span class="label-text-alt text-red-500 flex items-center">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                        </span>
                                    </label>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-tags mr-2 text-purple-500"></i>
                                            Kategori <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <select name="kategori" class="select select-bordered select-lg focus:select-primary transition-all duration-300 @error('kategori') select-error @enderror" required>
                                        <option value="">🏷️ Pilih Kategori Kegiatan</option>
                                        @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>
                                            @if($kategori == 'ibadah') 🙏 @elseif($kategori == 'retreat') ⛰️ @elseif($kategori == 'sosial') 🤝 @elseif($kategori == 'olahraga') ⚽ @elseif($kategori == 'pendidikan') 📚 @else 📋 @endif
                                            {{ ucfirst($kategori) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                    <label class="label">
                                        <span class="label-text-alt text-red-500 flex items-center">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                        </span>
                                    </label>
                                    @enderror
                                </div>

                                <!-- Status Publikasi -->
                                <div class="form-control">
                                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-xl border border-green-200">
                                        <label class="label cursor-pointer justify-start">
                                            <input type="checkbox" name="is_published" value="1"
                                                   {{ old('is_published') ? 'checked' : '' }}
                                                   class="checkbox checkbox-success mr-4 scale-125">
                                            <div>
                                                <span class="label-text font-semibold text-gray-800 flex items-center">
                                                    <i class="fas fa-globe mr-2 text-green-600"></i>
                                                    Publikasikan Dokumentasi
                                                </span>
                                                <p class="text-xs text-gray-600 mt-1">Centang untuk membuat dokumentasi ini dapat dilihat oleh semua anggota</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Section Title -->
                                <div class="flex items-center mb-6">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-image text-purple-600"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-800">Media & Deskripsi</h3>
                                </div>

                                <!-- Deskripsi -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-align-left mr-2 text-indigo-500"></i>
                                            Deskripsi Kegiatan
                                        </span>
                                    </label>
                                    <textarea name="deskripsi" rows="6"
                                              placeholder="Ceritakan tentang kegiatan ini... Apa yang dilakukan, siapa yang terlibat, dan bagaimana kesan peserta..."
                                              class="textarea textarea-bordered textarea-lg focus:textarea-primary transition-all duration-300 resize-none @error('deskripsi') textarea-error @enderror">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                    <label class="label">
                                        <span class="label-text-alt text-red-500 flex items-center">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                        </span>
                                    </label>
                                    @enderror
                                </div>

                                <!-- Upload Foto -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-camera mr-2 text-pink-500"></i>
                                            Foto Kegiatan
                                        </span>
                                    </label>
                                    <div class="relative">
                                        <input type="file" name="foto_kegiatan[]" multiple accept="image/*"
                                               class="file-input file-input-bordered file-input-lg file-input-primary w-full @error('foto_kegiatan.*') file-input-error @enderror">
                                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-400"></i>
                                        </div>
                                    </div>
                                    <label class="label">
                                        <span class="label-text-alt text-gray-500 flex items-center">
                                            <i class="fas fa-info-circle mr-2 text-blue-400"></i>
                                            Pilih beberapa foto sekaligus (JPEG, PNG, JPG, GIF). Maksimal 2MB per foto.
                                        </span>
                                    </label>
                                    @error('foto_kegiatan.*')
                                    <label class="label">
                                        <span class="label-text-alt text-red-500 flex items-center">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                        </span>
                                    </label>
                                    @enderror
                                </div>

                                <!-- Preview Area -->
                                <div id="preview-container" class="hidden">
                                    <label class="label">
                                        <span class="label-text font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-eye mr-2 text-green-500"></i>
                                            Preview Foto
                                        </span>
                                    </label>
                                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-xl border-2 border-dashed border-gray-300">
                                        <div id="preview-images" class="grid grid-cols-2 md:grid-cols-3 gap-3"></div>
                                    </div>
                                </div>

                                <!-- Tips -->
                                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-4 rounded-xl border border-yellow-200">
                                    <div class="flex items-start">
                                        <i class="fas fa-lightbulb text-yellow-600 text-xl mr-3 mt-1"></i>
                                        <div>
                                            <h4 class="font-semibold text-gray-800 mb-2">💡 Tips Dokumentasi yang Baik:</h4>
                                            <ul class="text-sm text-gray-600 space-y-1">
                                                <li>• Pilih foto dengan kualitas yang baik dan pencahayaan cukup</li>
                                                <li>• Sertakan foto kegiatan, peserta, dan suasana</li>
                                                <li>• Tulis deskripsi yang informatif dan menarik</li>
                                                <li>• Pastikan tanggal dan lokasi sudah benar</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="border-t border-gray-200 pt-8 mt-8">
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                                    Data akan disimpan dengan aman
                                </div>
                                <div class="flex gap-4">
                                    <a href="{{ route('dokumentasi.index') }}" class="btn btn-outline btn-lg">
                                        <i class="fas fa-times mr-2"></i>
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg bg-gradient-to-r from-blue-500 to-purple-600 border-none hover:from-blue-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-300">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan Dokumentasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('error'))
<div class="toast toast-top toast-end z-50">
    <div class="alert alert-error shadow-lg">
        <div>
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.querySelector('input[name="foto_kegiatan[]"]');
    const previewContainer = document.getElementById('preview-container');
    const previewImages = document.getElementById('preview-images');

    fileInput.addEventListener('change', function(e) {
        const files = e.target.files;
        previewImages.innerHTML = '';

        if (files.length > 0) {
            previewContainer.classList.remove('hidden');

            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imageContainer = document.createElement('div');
                        imageContainer.className = 'relative group';

                        imageContainer.innerHTML = `
                            <div class="aspect-square rounded-lg overflow-hidden bg-gray-100 shadow-md hover:shadow-lg transition-all duration-300">
                                <img src="${e.target.result}"
                                     alt="Preview ${index + 1}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="absolute top-2 right-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded-full">
                                ${index + 1}
                            </div>
                        `;

                        previewImages.appendChild(imageContainer);
                    };
                    reader.readAsDataURL(file);
                }
            });
        } else {
            previewContainer.classList.add('hidden');
        }
    });

    // Auto-hide toast after 5 seconds
    const toast = document.querySelector('.toast');
    if (toast) {
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 5000);
    }

    // Form validation enhancement
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });

    // Add smooth animations to form elements
    const formElements = document.querySelectorAll('.form-control input, .form-control select, .form-control textarea');
    formElements.forEach(element => {
        element.addEventListener('focus', function() {
            this.parentElement.classList.add('scale-105');
        });

        element.addEventListener('blur', function() {
            this.parentElement.classList.remove('scale-105');
        });
    });
});
</script>
@endpush
