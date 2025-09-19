<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dokumentasi;
use App\Models\User;
use Carbon\Carbon;

class DokumentasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada user admin untuk dijadikan creator
        $admin = User::where('is_admin', true)->first();
        
        if (!$admin) {
            // Jika tidak ada admin, buat user admin sementara
            $admin = User::create([
                'name' => 'Admin AMGPM',
                'email' => 'admin@amgpm.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'nama' => 'Administrator',
                'nomor_telepon' => '081234567890',
                'alamat' => 'Gereja AMGPM Ranting Parthenos',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'status_pernikahan' => 'Menikah',
                'pekerjaan' => 'Administrator',
                'email_verified_at' => now(),
            ]);
        }

        $dokumentasiData = [
            [
                'judul' => 'Ibadah Minggu Pagi - Kebaktian Umum',
                'deskripsi' => 'Dokumentasi kebaktian umum Minggu pagi dengan tema "Kasih yang Sejati". Kebaktian dihadiri oleh sekitar 150 jemaat dengan suasana yang khidmat dan penuh berkat.',
                'tanggal_kegiatan' => Carbon::now()->subDays(7),
                'lokasi' => 'Gereja AMGPM Ranting Parthenos',
                'kategori' => 'ibadah',
                'foto_kegiatan' => [
                    'dokumentasi/sample/ibadah-minggu-1.jpg',
                    'dokumentasi/sample/ibadah-minggu-2.jpg',
                    'dokumentasi/sample/ibadah-minggu-3.jpg'
                ],
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'judul' => 'Retreat Pemuda AMGPM 2024',
                'deskripsi' => 'Kegiatan retreat pemuda AMGPM dengan tema "Generasi Penerus yang Beriman". Diikuti oleh 45 pemuda dari berbagai ranting dengan berbagai kegiatan spiritual dan rekreasi.',
                'tanggal_kegiatan' => Carbon::now()->subDays(14),
                'lokasi' => 'Villa Puncak, Bogor',
                'kategori' => 'retreat',
                'foto_kegiatan' => [
                    'dokumentasi/sample/retreat-pemuda-1.jpg',
                    'dokumentasi/sample/retreat-pemuda-2.jpg',
                    'dokumentasi/sample/retreat-pemuda-3.jpg',
                    'dokumentasi/sample/retreat-pemuda-4.jpg'
                ],
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'judul' => 'Bakti Sosial - Bantuan untuk Korban Bencana',
                'deskripsi' => 'Kegiatan bakti sosial memberikan bantuan kepada korban bencana alam. Tim relawan AMGPM menyalurkan bantuan berupa sembako, pakaian, dan obat-obatan.',
                'tanggal_kegiatan' => Carbon::now()->subDays(21),
                'lokasi' => 'Desa Sukamaju, Garut',
                'kategori' => 'sosial',
                'foto_kegiatan' => [
                    'dokumentasi/sample/baksos-1.jpg',
                    'dokumentasi/sample/baksos-2.jpg'
                ],
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'judul' => 'Pelatihan Musik Gereja',
                'deskripsi' => 'Workshop pelatihan musik gereja untuk meningkatkan kualitas pelayanan musik dalam ibadah. Diikuti oleh 25 peserta dari berbagai kelompok musik.',
                'tanggal_kegiatan' => Carbon::now()->subDays(10),
                'lokasi' => 'Aula Gereja AMGPM Ranting Parthenos',
                'kategori' => 'pelatihan',
                'foto_kegiatan' => [
                    'dokumentasi/sample/pelatihan-musik-1.jpg',
                    'dokumentasi/sample/pelatihan-musik-2.jpg',
                    'dokumentasi/sample/pelatihan-musik-3.jpg'
                ],
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'judul' => 'Natal Bersama Keluarga Besar AMGPM',
                'deskripsi' => 'Perayaan Natal bersama keluarga besar AMGPM dengan berbagai acara menarik termasuk drama natal, paduan suara, dan pembagian hadiah untuk anak-anak.',
                'tanggal_kegiatan' => Carbon::create(2023, 12, 25),
                'lokasi' => 'Gedung Serbaguna AMGPM',
                'kategori' => 'perayaan',
                'foto_kegiatan' => [
                    'dokumentasi/sample/natal-1.jpg',
                    'dokumentasi/sample/natal-2.jpg',
                    'dokumentasi/sample/natal-3.jpg',
                    'dokumentasi/sample/natal-4.jpg',
                    'dokumentasi/sample/natal-5.jpg'
                ],
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'judul' => 'Kunjungan Pastoral ke Jemaat Lansia',
                'deskripsi' => 'Kegiatan kunjungan pastoral khusus untuk jemaat lansia yang sudah tidak bisa hadir ke gereja. Tim pastoral memberikan pelayanan rohani dan dukungan.',
                'tanggal_kegiatan' => Carbon::now()->subDays(5),
                'lokasi' => 'Rumah Jemaat (Berbagai Lokasi)',
                'kategori' => 'pastoral',
                'foto_kegiatan' => [
                    'dokumentasi/sample/pastoral-1.jpg',
                    'dokumentasi/sample/pastoral-2.jpg'
                ],
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'judul' => 'Seminar Keluarga Kristen',
                'deskripsi' => 'Seminar tentang membangun keluarga Kristen yang harmonis dengan pembicara Pdt. Dr. John Doe. Dihadiri oleh 80 pasangan suami istri.',
                'tanggal_kegiatan' => Carbon::now()->subDays(30),
                'lokasi' => 'Aula Gereja AMGPM Ranting Parthenos',
                'kategori' => 'seminar',
                'foto_kegiatan' => [
                    'dokumentasi/sample/seminar-keluarga-1.jpg',
                    'dokumentasi/sample/seminar-keluarga-2.jpg',
                    'dokumentasi/sample/seminar-keluarga-3.jpg'
                ],
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'judul' => 'Kebaktian Syukur HUT Gereja ke-50',
                'deskripsi' => 'Kebaktian syukur memperingati HUT Gereja AMGPM Ranting Parthenos yang ke-50 tahun. Acara dihadiri oleh jemaat, tamu undangan, dan pejabat daerah.',
                'tanggal_kegiatan' => Carbon::now()->subDays(60),
                'lokasi' => 'Gereja AMGPM Ranting Parthenos',
                'kategori' => 'perayaan',
                'foto_kegiatan' => [
                    'dokumentasi/sample/hut-gereja-1.jpg',
                    'dokumentasi/sample/hut-gereja-2.jpg',
                    'dokumentasi/sample/hut-gereja-3.jpg',
                    'dokumentasi/sample/hut-gereja-4.jpg'
                ],
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'judul' => 'Kegiatan Sekolah Minggu - Tema Kasih Sayang',
                'deskripsi' => 'Kegiatan Sekolah Minggu dengan tema "Kasih Sayang Yesus" yang diikuti oleh 35 anak-anak dengan berbagai permainan edukatif dan cerita Alkitab.',
                'tanggal_kegiatan' => Carbon::now()->subDays(3),
                'lokasi' => 'Ruang Sekolah Minggu AMGPM',
                'kategori' => 'anak',
                'foto_kegiatan' => [
                    'dokumentasi/sample/sekolah-minggu-1.jpg',
                    'dokumentasi/sample/sekolah-minggu-2.jpg',
                    'dokumentasi/sample/sekolah-minggu-3.jpg'
                ],
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'judul' => 'Rapat Koordinasi Pengurus Gereja',
                'deskripsi' => 'Rapat koordinasi bulanan pengurus gereja membahas program kerja dan evaluasi kegiatan bulan sebelumnya. Draft untuk dokumentasi internal.',
                'tanggal_kegiatan' => Carbon::now()->subDays(2),
                'lokasi' => 'Ruang Rapat Gereja AMGPM',
                'kategori' => 'rapat',
                'foto_kegiatan' => [
                    'dokumentasi/sample/rapat-pengurus-1.jpg'
                ],
                'is_published' => false, // Draft, belum dipublikasi
                'created_by' => $admin->id,
            ]
        ];

        foreach ($dokumentasiData as $data) {
            Dokumentasi::create($data);
        }

        $this->command->info('✅ Seeder dokumentasi kegiatan berhasil dijalankan!');
        $this->command->info('📊 Total ' . count($dokumentasiData) . ' dokumentasi kegiatan telah ditambahkan.');
        $this->command->info('📝 Termasuk ' . collect($dokumentasiData)->where('is_published', false)->count() . ' draft dan ' . collect($dokumentasiData)->where('is_published', true)->count() . ' yang sudah dipublikasi.');
    }
}