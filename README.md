# AMGPM - Sistem Informasi Ranting Parthenos

![AMGPM Logo](public/img/logo-amgpm.png)

Sistem Informasi AMGPM (Angkatan Muda Gereja Protestan Maluku) Ranting Parthenos adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola data keanggotaan, jadwal ibadah, dan komunikasi WhatsApp untuk organisasi gereja.

## 🚀 Fitur Utama

### 📊 Dashboard

-   **Statistik Real-time**: Menampilkan total anggota, kegiatan mendatang, dan ulang tahun
-   **Widget Informatif**: Ringkasan data penting dalam tampilan yang mudah dipahami
-   **Navigasi Intuitif**: Akses cepat ke semua fitur utama

### 👥 Manajemen Anggota

-   **Database Anggota Lengkap**: Menyimpan data pribadi anggota (nama, email, tempat/tanggal lahir, golongan darah, WhatsApp)
-   **Sistem Role**: Pembagian hak akses antara Administrator dan Member
-   **Pencarian & Filter**: Cari anggota berdasarkan nama, email, atau status admin
-   **Reset Password**: Fitur reset password otomatis berdasarkan tanggal lahir (format: YYYYMMDD)
-   **Validasi Data**: Validasi email dan nomor WhatsApp yang unik

### ⛪ Manajemen Jadwal Ibadah

-   **CRUD Jadwal**: Tambah, edit, hapus, dan lihat jadwal ibadah
-   **Detail Lengkap**: Nama ibadah, tanggal, waktu, lokasi, pemimpin, pemandu, tema, dan catatan
-   **Pencarian Advanced**: Cari berdasarkan nama, lokasi, pemimpin, pemandu, atau catatan
-   **Filter Tanggal**: Filter jadwal berdasarkan rentang tanggal
-   **Scope Query**: Jadwal mendatang, hari ini, dan yang sudah lewat
-   **Tracking User**: Mencatat siapa yang membuat/mengubah jadwal

### 🎂 Jadwal Ulang Tahun

-   **Kalender Ulang Tahun**: Tampilkan anggota yang berulang tahun per bulan
-   **Filter Bulanan**: Pilih bulan untuk melihat daftar ulang tahun
-   **Sorting Otomatis**: Urutkan berdasarkan tanggal dalam bulan
-   **Widget Dashboard**: Tampilkan ulang tahun bulan ini dan minggu ini

### 📱 WhatsApp Gateway Integration

-   **Multi-Session Management**: Kelola multiple sesi WhatsApp menggunakan wa-gateway
-   **Status Monitoring**: Real-time monitoring status koneksi gateway
-   **QR Code Authentication**: Login WhatsApp melalui QR code
-   **Pengiriman Pesan**: Kirim pesan teks, gambar, dan dokumen
-   **Contact Integration**: Pilih kontak dari database anggota
-   **Message History**: Log pesan yang telah dikirim
-   **Auto-hide Features**: Sembunyikan fitur saat gateway tidak aktif

### 🔐 Sistem Autentikasi

-   **Multi-Login**: Login menggunakan email atau nomor WhatsApp
-   **Session Management**: Pengelolaan sesi yang aman
-   **Role-based Access**: Kontrol akses berdasarkan role user
-   **Profile Management**: Edit profil dan ubah password

## 🛠️ Teknologi yang Digunakan

### Backend

-   **Laravel 11**: Framework PHP modern
-   **MySQL**: Database relational
-   **Eloquent ORM**: Object-Relational Mapping
-   **Laravel Factories & Seeders**: Data seeding dan testing

### Frontend

-   **Blade Templates**: Template engine Laravel
-   **Tailwind CSS**: Utility-first CSS framework
-   **DaisyUI**: Component library untuk Tailwind
-   **Font Awesome**: Icon library
-   **JavaScript Vanilla**: Interaksi frontend

### WhatsApp Integration

-   **wa-gateway**: Node.js WhatsApp gateway
-   **wa-multi-session**: Multi-session WhatsApp library
-   **Hono**: Lightweight web framework untuk gateway

## 📋 Persyaratan Sistem

-   PHP >= 8.2
-   Composer
-   Node.js >= 18
-   MySQL >= 8.0
-   Git

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd amgpm
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies untuk wa-gateway
cd wa-gateway
npm install
cd ..
```

### 3. Konfigurasi Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=amgpm
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Migrasi dan Seeding

```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder (opsional)
php artisan db:seed
```

### 6. Konfigurasi WhatsApp Gateway

Edit file `wa-gateway/.env`:

```env
PORT=5001
```

## 🏃‍♂️ Menjalankan Aplikasi

### 1. Jalankan Laravel Server

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://127.0.0.1:8000`

### 2. Jalankan WhatsApp Gateway

```bash
cd wa-gateway
npm run start
```

Gateway akan berjalan di `http://localhost:5001`

## 👤 Akun Default

Setelah menjalankan seeder, tersedia akun default:

**Administrator:**

-   Email: `admin@amgpm.com`
-   Password: `admin@amgpm.com`

**User Biasa:**

-   Email: `user@amgpm.com`
-   Password: `user@amgpm.com`

## 📱 Penggunaan WhatsApp Gateway

### Setup Awal

1. Pastikan wa-gateway berjalan di `http://localhost:5001`
2. Akses menu **Pengaturan > WhatsApp** (hanya admin)
3. Klik tombol **Mulai Sesi** untuk memulai sesi WhatsApp
4. Scan QR code yang muncul dengan WhatsApp di ponsel
5. Tunggu hingga status berubah menjadi "Terhubung"

### Mengirim Pesan

1. Pilih kontak dari dropdown atau masukkan nomor manual
2. Tulis pesan yang ingin dikirim
3. Pilih jenis pesan (teks, gambar, atau dokumen)
4. Klik tombol kirim

## 🗂️ Struktur Database

### Tabel Users

-   `id`: Primary key
-   `nama`: Nama lengkap anggota
-   `email`: Email (unique)
-   `password`: Password (hashed)
-   `tempat_lahir`: Tempat lahir
-   `tanggal_lahir`: Tanggal lahir
-   `golongan_darah`: Golongan darah (A, B, AB, O)
-   `whatsapp`: Nomor WhatsApp (unique)
-   `is_admin`: Status administrator (boolean)
-   `email_verified_at`: Timestamp verifikasi email
-   `whatsapp_verified_at`: Timestamp verifikasi WhatsApp

### Tabel Ibadah

-   `id`: Primary key
-   `nama`: Nama ibadah
-   `tanggal`: Tanggal ibadah
-   `waktu`: Waktu ibadah
-   `lokasi`: Lokasi ibadah
-   `pemimpin`: Pemimpin ibadah
-   `pemandu`: Pemandu ibadah (nullable)
-   `tema`: Tema ibadah (nullable)
-   `catatan`: Catatan tambahan (nullable)
-   `user_id`: Foreign key ke users

## 🔧 Konfigurasi Tambahan

### WhatsApp Gateway URL

Dalam file `config/app.php`, terdapat konfigurasi:

```php
'wa_gateway_url' => env('WA_GATEWAY_URL', 'http://localhost:5001'),
```

Ubah di file `.env` jika gateway berjalan di port/host berbeda:

```env
WA_GATEWAY_URL=http://localhost:5001
```

## 🚨 Troubleshooting

### Gateway Tidak Terhubung

1. Pastikan wa-gateway berjalan di port 5001
2. Periksa firewall dan port yang digunakan
3. Cek log di terminal wa-gateway untuk error

### QR Code Tidak Muncul

1. Refresh halaman pengaturan WhatsApp
2. Restart wa-gateway
3. Hapus session lama dan buat session baru

### Pesan Tidak Terkirim

1. Pastikan nomor tujuan dalam format internasional (62xxx)
2. Periksa status koneksi WhatsApp
3. Cek apakah session masih aktif

## 🤝 Kontribusi

Untuk berkontribusi pada proyek ini:

1. Fork repository
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 Lisensi

Proyek ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail lebih lanjut.

## 📞 Kontak

Untuk pertanyaan atau dukungan, silakan hubungi:

-   Email: admin@amgpm.com
-   WhatsApp: +62 813-1881-2027

---

**AMGPM Ranting Parthenos** - Sistem Informasi untuk Angkatan Muda Gereja Protestan Maluku

_"Kelola data keanggotaan dan informasi ranting dengan mudah dan efisien."_
