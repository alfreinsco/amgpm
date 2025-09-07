@extends('layouts.app')

@section('title', 'Dokumentasi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="hero bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-2xl mb-8">
        <div class="hero-content text-center py-12">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold mb-4">
                    <i class="fas fa-book mr-3"></i>
                    Dokumentasi
                </h1>
                <p class="text-xl opacity-90">Panduan lengkap penggunaan Aplikasi Manajemen Angkatan Muda Gereja Protestant Maluku</p>
            </div>
        </div>
    </div>

    <!-- Navigation Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
            <div class="card-body">
                <div class="flex items-center mb-4">
                    <div class="avatar placeholder mr-3">
                        <div class="bg-blue-500 text-white rounded-full w-12">
                            <i class="fas fa-rocket text-xl"></i>
                        </div>
                    </div>
                    <h2 class="card-title text-blue-600">Memulai</h2>
                </div>
                <p class="text-gray-600">Panduan awal untuk menggunakan aplikasi AMGPM</p>
                <div class="card-actions justify-end mt-4">
                    <a href="#getting-started" class="btn btn-primary btn-sm">Pelajari</a>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
            <div class="card-body">
                <div class="flex items-center mb-4">
                    <div class="avatar placeholder mr-3">
                        <div class="bg-green-500 text-white rounded-full w-12">
                            <i class="fas fa-cogs text-xl"></i>
                        </div>
                    </div>
                    <h2 class="card-title text-green-600">Fitur Utama</h2>
                </div>
                <p class="text-gray-600">Jelajahi semua fitur yang tersedia dalam aplikasi</p>
                <div class="card-actions justify-end mt-4">
                    <a href="#features" class="btn btn-success btn-sm">Jelajahi</a>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
            <div class="card-body">
                <div class="flex items-center mb-4">
                    <div class="avatar placeholder mr-3">
                        <div class="bg-purple-500 text-white rounded-full w-12">
                            <i class="fas fa-question-circle text-xl"></i>
                        </div>
                    </div>
                    <h2 class="card-title text-purple-600">FAQ</h2>
                </div>
                <p class="text-gray-600">Pertanyaan yang sering diajukan dan solusinya</p>
                <div class="card-actions justify-end mt-4">
                    <a href="#faq" class="btn btn-secondary btn-sm">Lihat FAQ</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Getting Started Section -->
    <div id="getting-started" class="card bg-base-100 shadow-xl mb-8">
        <div class="card-body">
            <h2 class="card-title text-2xl text-blue-600 mb-6">
                <i class="fas fa-rocket mr-2"></i>
                Memulai Menggunakan AMGPM
            </h2>

            <div class="steps steps-vertical lg:steps-horizontal">
                <div class="step step-primary">
                    <div class="step-content">
                        <h3 class="font-semibold">Login ke Sistem</h3>
                        <p class="text-sm text-gray-600">Masuk menggunakan akun yang telah diberikan admin</p>
                    </div>
                </div>
                <div class="step step-primary">
                    <div class="step-content">
                        <h3 class="font-semibold">Jelajahi Dashboard</h3>
                        <p class="text-sm text-gray-600">Lihat ringkasan informasi di halaman beranda</p>
                    </div>
                </div>
                <div class="step step-primary">
                    <div class="step-content">
                        <h3 class="font-semibold">Gunakan Fitur</h3>
                        <p class="text-sm text-gray-600">Akses berbagai fitur sesuai hak akses Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="card bg-base-100 shadow-xl mb-8">
        <div class="card-body">
            <h2 class="card-title text-2xl text-green-600 mb-6">
                <i class="fas fa-cogs mr-2"></i>
                Fitur Utama Aplikasi
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-tachometer-alt text-blue-500 text-xl mr-3"></i>
                        <h3 class="font-semibold text-lg">Dashboard</h3>
                    </div>
                    <p class="text-gray-600 mb-3">Ringkasan informasi penting seperti jumlah anggota, kegiatan mendatang, dan ulang tahun.</p>
                    <div class="badge badge-primary badge-outline">Semua User</div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-users text-green-500 text-xl mr-3"></i>
                        <h3 class="font-semibold text-lg">Database Anggota</h3>
                    </div>
                    <p class="text-gray-600 mb-3">Manajemen data anggota gereja termasuk informasi pribadi dan kontak.</p>
                    <div class="badge badge-error badge-outline">Admin Only</div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-church text-purple-500 text-xl mr-3"></i>
                        <h3 class="font-semibold text-lg">Jadwal Ibadah</h3>
                    </div>
                    <p class="text-gray-600 mb-3">Kelola dan lihat jadwal kegiatan ibadah dengan fitur pencarian dan filter.</p>
                    <div class="badge badge-primary badge-outline">Semua User</div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-birthday-cake text-pink-500 text-xl mr-3"></i>
                        <h3 class="font-semibold text-lg">Jadwal Ulang Tahun</h3>
                    </div>
                    <p class="text-gray-600 mb-3">Lihat jadwal ulang tahun anggota gereja yang akan datang.</p>
                    <div class="badge badge-primary badge-outline">Semua User</div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <i class="fab fa-whatsapp text-green-600 text-xl mr-3"></i>
                        <h3 class="font-semibold text-lg">WhatsApp Gateway</h3>
                    </div>
                    <p class="text-gray-600 mb-3">Integrasi dengan WhatsApp untuk mengirim pesan kepada anggota gereja.</p>
                    <div class="badge badge-error badge-outline">Admin Only</div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-cog text-indigo-500 text-xl mr-3"></i>
                        <h3 class="font-semibold text-lg">Manajemen Profil</h3>
                    </div>
                    <p class="text-gray-600 mb-3">Update informasi profil dan ubah password akun.</p>
                    <div class="badge badge-primary badge-outline">Semua User</div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div id="faq" class="card bg-base-100 shadow-xl mb-8">
        <div class="card-body">
            <h2 class="card-title text-2xl text-purple-600 mb-6">
                <i class="fas fa-question-circle mr-2"></i>
                Frequently Asked Questions
            </h2>

            <div class="collapse-group">
                <div class="collapse collapse-arrow bg-base-200 mb-2">
                    <input type="radio" name="faq-accordion" checked="checked" />
                    <div class="collapse-title text-lg font-medium">
                        Bagaimana cara mengakses fitur admin?
                    </div>
                    <div class="collapse-content">
                        <p>Fitur admin hanya dapat diakses oleh user dengan role Administrator. Hubungi admin sistem untuk mendapatkan hak akses admin.</p>
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-200 mb-2">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-lg font-medium">
                        Bagaimana cara menggunakan WhatsApp Gateway?
                    </div>
                    <div class="collapse-content">
                        <p>Pastikan wa-gateway sudah berjalan, lalu buka menu Pengaturan > WhatsApp. Scan QR code untuk menghubungkan WhatsApp, kemudian Anda dapat mengirim pesan kepada anggota.</p>
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-200 mb-2">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-lg font-medium">
                        Bagaimana cara menambah anggota baru?
                    </div>
                    <div class="collapse-content">
                        <p>Buka menu Database Anggota (khusus admin), klik tombol "Tambah Anggota", isi form dengan lengkap, dan klik simpan.</p>
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-200 mb-2">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-lg font-medium">
                        Bagaimana cara mengubah password?
                    </div>
                    <div class="collapse-content">
                        <p>Klik nama Anda di pojok kanan atas, pilih "Profile", kemudian klik "Update Password" dan isi form yang tersedia.</p>
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-200 mb-2">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-lg font-medium">
                        Bagaimana cara mencari jadwal ibadah tertentu?
                    </div>
                    <div class="collapse-content">
                        <p>Di halaman Jadwal Ibadah, gunakan form pencarian untuk mencari berdasarkan nama kegiatan atau gunakan filter tanggal untuk melihat jadwal pada periode tertentu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
     <div class="card bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-xl mb-8">
         <div class="card-body text-center">
             <h2 class="card-title text-2xl justify-center mb-4">
                 <i class="fas fa-headset mr-2"></i>
                 Butuh Bantuan?
             </h2>
             <p class="text-lg opacity-90 mb-6">Tim support kami siap membantu Anda</p>
             <div class="flex flex-wrap justify-center gap-4">
                 <div class="badge badge-lg bg-white text-indigo-600 border-0">
                     <i class="fas fa-envelope mr-2"></i>
                     alfreinsco@gmail.com
                 </div>
                 <div class="badge badge-lg bg-white text-indigo-600 border-0">
                     <i class="fas fa-phone mr-2"></i>
                     +62 813 1881 2027
                 </div>
             </div>
         </div>
     </div>

     <!-- Footer -->
     <footer class="footer footer-center bg-base-200 text-base-content rounded-2xl p-8">
         <div class="flex flex-col items-center space-y-4">
             <div class="flex items-center space-x-3">
                 <div class="avatar">
                     <div class="w-12 rounded-full overflow-hidden">
                         <img src="https://alfreinsco.vercel.app/_next/image?url=%2Fimg%2Fmarthin.jpeg&w=1200&q=75"
                              alt="Developer Avatar"
                              class="w-full h-full object-cover">
                     </div>
                 </div>
                 <div class="text-left">
                     <p class="font-semibold text-lg">Dibuat oleh</p>
                     <a href="https://alfreinsco.vercel.app/" target="_blank" class="link link-primary font-bold text-xl hover:text-purple-600 transition-colors">
                         ALFREINSCO
                     </a>
                 </div>
             </div>
             <div class="text-center">
                 <p class="text-sm opacity-70">Full Stack Developer & UI/UX Designer</p>
                 <p class="text-xs opacity-50 mt-1">Aplikasi Manajemen Angkatan Muda Gereja Protestant Maluku © {{ date('Y') }}</p>
             </div>
             <div class="flex space-x-4">
                 <a href="https://alfreinsco.vercel.app/" target="_blank" class="btn btn-circle btn-outline btn-sm hover:btn-primary">
                     <i class="fas fa-globe"></i>
                 </a>
                 <a href="mailto:alfreinsco@gmail.com" class="btn btn-circle btn-outline btn-sm hover:btn-secondary">
                     <i class="fas fa-envelope"></i>
                 </a>
                 <a href="tel:+6281318812027" class="btn btn-circle btn-outline btn-sm hover:btn-accent">
                     <i class="fas fa-phone"></i>
                 </a>
             </div>
         </div>
     </footer>
 </div>
 @endsection
