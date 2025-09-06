# Pagination Component

Component pagination yang reusable untuk aplikasi Laravel.

## Lokasi File
`resources/views/components/pagination.blade.php`

## Cara Penggunaan

### Syntax Dasar
```blade
<x-pagination :paginator="$data" />
```

### Dengan Label Custom
```blade
<x-pagination :paginator="$data" label="item" />
```

### Contoh Penggunaan di Berbagai Halaman

#### 1. Halaman Anggota
```blade
<x-pagination :paginator="$anggota" label="anggota" />
```

#### 2. Halaman Ibadah
```blade
<x-pagination :paginator="$ibadah" label="ibadah" />
```

#### 3. Halaman User
```blade
<x-pagination :paginator="$users" label="pengguna" />
```

#### 4. Halaman Laporan
```blade
<x-pagination :paginator="$laporan" label="laporan" />
```

## Parameter

| Parameter | Type | Required | Default | Deskripsi |
|-----------|------|----------|---------|----------|
| `paginator` | LengthAwarePaginator | Ya | - | Object paginator dari Laravel |
| `label` | String | Tidak | "item" | Label untuk menampilkan jenis data |

## Fitur

- ✅ Responsive design (desktop & mobile)
- ✅ Tombol First, Previous, Next, Last
- ✅ Smart pagination (menampilkan ellipsis jika halaman banyak)
- ✅ Informasi jumlah data
- ✅ Modern styling dengan Tailwind CSS
- ✅ Hover effects dan transitions
- ✅ Accessibility support

## Tampilan

### Desktop
- Menampilkan semua tombol navigasi
- Smart pagination dengan ellipsis
- Label teks pada tombol Previous/Next

### Mobile
- Hanya menampilkan indikator halaman aktif
- Tombol navigasi tetap tersedia
- Optimized untuk layar kecil

## Styling

Component menggunakan Tailwind CSS dengan tema:
- Primary color: Blue (bg-blue-600)
- Border radius: rounded-lg
- Shadow effects
- Smooth transitions

## Persyaratan

- Laravel 8+
- Tailwind CSS
- Font Awesome (untuk ikon)
- Data harus menggunakan `paginate()` method dari Eloquent