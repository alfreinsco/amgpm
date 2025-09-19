@extends('layouts.app')

@section('title', 'Edit Dokumentasi Kegiatan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Animated Header -->
        <div class="text-center mb-8 animate-fade-in-down">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4 shadow-lg">
                <i class="fas fa-edit text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                Edit Dokumentasi Kegiatan
            </h1>
            <p class="text-gray-600 text-lg">Perbarui informasi dokumentasi: <span class="font-semibold text-indigo-600">{{ $dokumentasi->judul }}</span></p>
            
            <!-- Breadcrumb -->
            <div class="flex items-center justify-center mt-4 text-sm text-gray-500">
                <a href="{{ route('dokumentasi.index') }}" class="hover:text-indigo-600 transition-colors">
                    <i class="fas fa-home mr-1"></i>Dokumentasi
                </a>
                <i class="fas fa-chevron-right mx-2"></i>
                <a href="{{ route('dokumentasi.show', $dokumentasi) }}" class="hover:text-indigo-600 transition-colors">
                    {{ Str::limit($dokumentasi->judul, 30) }}
                </a>
                <i class="fas fa-chevron-right mx-2"></i>
                <span class="text-indigo-600 font-medium">Edit</span>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-white">
                            <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-edit text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold">Form Edit Dokumentasi</h2>
                                <p class="text-blue-100 text-sm">Lengkapi informasi di bawah ini dengan teliti</p>
                            </div>
                        </div>
                        <a href="{{ route('dokumentasi.show', $dokumentasi) }}" 
                           class="btn btn-ghost text-white hover:bg-white hover:bg-opacity-20 border-white border-opacity-30">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form action="{{ route('dokumentasi.update', $dokumentasi) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')
                        
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
                                    <input type="text" name="judul" value="{{ old('judul', $dokumentasi->judul) }}" 
                                           placeholder="Masukkan judul kegiatan yang menarik..." 
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
                                    <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $dokumentasi->tanggal_kegiatan->format('Y-m-d')) }}" 
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
                                    <input type="text" name="lokasi" value="{{ old('lokasi', $dokumentasi->lokasi) }}" 
                                           placeholder="Contoh: Gereja AMGPM Pusat, Jakarta" 
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
                                        <option value="">Pilih kategori yang sesuai...</option>
                                        @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori }}" {{ old('kategori', $dokumentasi->kategori) == $kategori ? 'selected' : '' }}>
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
                                                   {{ old('is_published', $dokumentasi->is_published) ? 'checked' : '' }} 
                                                   class="checkbox checkbox-success checkbox-lg mr-4">
                                            <div>
                                                <span class="label-text font-semibold text-gray-800 flex items-center">
                                                    <i class="fas fa-globe mr-2 text-green-600"></i>
                                                    Publikasikan dokumentasi
                                                </span>
                                                <p class="text-sm text-gray-600 mt-1">Centang untuk membuat dokumentasi ini dapat dilihat oleh semua anggota</p>
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
                                              placeholder="Perbarui deskripsi kegiatan... Ceritakan perubahan atau tambahan informasi..." 
                                              class="textarea textarea-bordered textarea-lg focus:textarea-primary transition-all duration-300 resize-none @error('deskripsi') textarea-error @enderror">{{ old('deskripsi', $dokumentasi->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                    <label class="label">
                                        <span class="label-text-alt text-red-500 flex items-center">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                        </span>
                                    </label>
                                    @enderror
                                </div>

                                <!-- Upload Foto Baru -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-camera-retro mr-2 text-pink-500"></i>
                                            Upload Foto Baru
                                        </span>
                                    </label>
                                    <div class="relative">
                                        <input type="file" name="foto_kegiatan[]" multiple accept="image/*" 
                                               class="file-input file-input-bordered file-input-lg file-input-secondary w-full @error('foto_kegiatan.*') file-input-error @enderror">
                                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-400"></i>
                                        </div>
                                    </div>
                                    <label class="label">
                                        <span class="label-text-alt text-gray-500 flex items-center">
                                            <i class="fas fa-info-circle mr-2 text-blue-400"></i>
                                            Pilih foto baru untuk mengganti semua foto lama. Kosongkan jika tidak ingin mengubah foto.
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

                                <!-- Preview Foto Baru -->
                                <div id="preview-container" class="hidden">
                                    <label class="label">
                                        <span class="label-text font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-eye mr-2 text-green-500"></i>
                                            Preview Foto Baru
                                        </span>
                                    </label>
                                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-xl border-2 border-dashed border-gray-300">
                                        <div id="preview-images" class="grid grid-cols-2 md:grid-cols-3 gap-3"></div>
                                    </div>
                                </div>

                                <!-- Tips Update -->
                                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-xl border border-blue-200">
                                    <div class="flex items-start">
                                        <i class="fas fa-lightbulb text-blue-600 text-xl mr-3 mt-1"></i>
                                        <div>
                                            <h4 class="font-semibold text-gray-800 mb-2">💡 Tips Update Dokumentasi:</h4>
                                            <ul class="text-sm text-gray-600 space-y-1">
                                                <li>• Periksa kembali informasi yang sudah diisi</li>
                                                <li>• Upload foto baru hanya jika diperlukan</li>
                                                <li>• Pastikan deskripsi sudah akurat dan terkini</li>
                                                <li>• Cek status publikasi sebelum menyimpan</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Foto Saat Ini -->
                        @if($dokumentasi->foto_kegiatan && count($dokumentasi->foto_kegiatan) > 0)
                        <div class="border-t border-gray-200 pt-8 mt-8">
                            <div class="flex items-center mb-6">
                                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-images text-orange-600"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800">Foto Saat Ini</h3>
                                <span class="ml-3 px-3 py-1 bg-gray-100 text-gray-600 text-sm rounded-full">
                                    {{ count($dokumentasi->foto_kegiatan) }} foto
                                </span>
                            </div>
                            
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-xl">
                                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                    @foreach($dokumentasi->foto_kegiatan as $index => $foto)
                                    <div class="relative group">
                                        <div class="aspect-square rounded-lg overflow-hidden bg-white shadow-md hover:shadow-lg transition-all duration-300">
                                            <img src="{{ asset('storage/' . $foto) }}" 
                                                 alt="Foto {{ $index + 1 }}" 
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-lg flex items-center justify-center">
                                            <button type="button" 
                                                    onclick="removePhoto({{ $dokumentasi->id }}, {{ $index }})"
                                                    class="btn btn-error btn-sm hover:btn-error transform hover:scale-110 transition-all duration-200">
                                                <i class="fas fa-trash mr-1"></i>
                                                Hapus
                                            </button>
                                        </div>
                                        <div class="absolute top-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded-full font-medium">
                                            {{ $index + 1 }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                    <div class="flex items-center text-yellow-800 text-sm">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>Klik tombol "Hapus" pada foto untuk menghapus foto individual, atau upload foto baru untuk mengganti semua foto.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="border-t border-gray-200 pt-8 mt-8">
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                                    Perubahan akan disimpan dengan aman
                                </div>
                                <div class="flex gap-4">
                                    <a href="{{ route('dokumentasi.show', $dokumentasi) }}" class="btn btn-outline btn-lg">
                                        <i class="fas fa-times mr-2"></i>
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg bg-gradient-to-r from-blue-500 to-purple-600 border-none hover:from-blue-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-300">
                                        <i class="fas fa-save mr-2"></i>
                                        Update Dokumentasi
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
<div class="toast toast-top toast-end z-50 shadow-lg">
    <div class="alert alert-error">
        <i class="fas fa-exclamation-triangle"></i>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form animation on load
    const form = document.querySelector('form');
    if (form) {
        form.style.opacity = '0';
        form.style.transform = 'translateY(20px)';
        setTimeout(() => {
            form.style.transition = 'all 0.6s ease-out';
            form.style.opacity = '1';
            form.style.transform = 'translateY(0)';
        }, 100);
    }

    // Auto-hide toast after 5 seconds
    const toast = document.querySelector('.toast');
    if (toast) {
        setTimeout(() => {
            toast.style.transition = 'all 0.5s ease-out';
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 500);
        }, 5000);
    }

    // Preview gambar saat upload
    const fileInput = document.querySelector('input[name="foto_kegiatan[]"]');
    const previewContainer = document.getElementById('preview-container');
    const previewImages = document.getElementById('preview-images');

    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const files = e.target.files;
            previewImages.innerHTML = '';
            
            if (files.length > 0) {
                previewContainer.classList.remove('hidden');
                previewContainer.style.opacity = '0';
                previewContainer.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    previewContainer.style.transition = 'all 0.4s ease-out';
                    previewContainer.style.opacity = '1';
                    previewContainer.style.transform = 'translateY(0)';
                }, 100);
                
                Array.from(files).forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imageDiv = document.createElement('div');
                            imageDiv.className = 'relative group';
                            imageDiv.innerHTML = `
                                <div class="aspect-square rounded-lg overflow-hidden bg-white shadow-md hover:shadow-lg transition-all duration-300">
                                    <img src="${e.target.result}" alt="Preview ${index + 1}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                                    Baru
                                </div>
                                <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded-full">
                                    ${index + 1}
                                </div>
                            `;
                            previewImages.appendChild(imageDiv);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                previewContainer.classList.add('hidden');
            }
        });
    }

    // Smooth scroll untuk form yang panjang
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });
});

// Fungsi untuk menghapus foto
function removePhoto(dokumentasiId, photoIndex) {
    if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
        // Animasi loading
        const button = event.target.closest('button');
        const originalContent = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
        button.disabled = true;

        fetch(`/admin/dokumentasi/${dokumentasiId}/remove-photo`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                photo_index: photoIndex
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Animasi fade out
                const photoDiv = button.closest('.relative');
                photoDiv.style.transition = 'all 0.5s ease-out';
                photoDiv.style.opacity = '0';
                photoDiv.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    location.reload();
                }, 500);
            } else {
                alert('Gagal menghapus foto: ' + (data.message || 'Terjadi kesalahan'));
                button.innerHTML = originalContent;
                button.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus foto');
            button.innerHTML = originalContent;
            button.disabled = false;
        });
    }
}
</script>
@endpush