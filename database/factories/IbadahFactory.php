<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ibadah>
 */
class IbadahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisIbadah = [
            'Ibadah Minggu Pagi',
            'Ibadah Minggu Sore',
            'Ibadah Pemuda',
            'Ibadah Anak',
            'Ibadah Keluarga',
            'Ibadah Doa',
            'Ibadah Syukur',
            'Ibadah Paskah',
            'Ibadah Natal',
            'Ibadah Tahun Baru'
        ];

        $lokasi = [
            'Gereja AMGPM Parthenos',
            'Aula Gereja',
            'Ruang Serbaguna',
            'Halaman Gereja',
            'Rumah Jemaat'
        ];

        $pemimpin = [
            'Pdt. John Doe',
            'Pdt. Jane Smith',
            'Ev. Michael Johnson',
            'Ev. Sarah Wilson',
            'Pnt. David Brown',
            'Pnt. Lisa Davis'
        ];

        $pemandu = [
            'Bro. Alex Thompson',
            'Sis. Maria Garcia',
            'Bro. Robert Lee',
            'Sis. Jennifer White',
            'Bro. Christopher Hall',
            'Sis. Amanda Clark'
        ];

        $tema = [
            'Kasih Allah yang Sempurna',
            'Hidup dalam Terang Kristus',
            'Berkat Tuhan dalam Keluarga',
            'Pengharapan di Tengah Badai',
            'Sukacita dalam Penderitaan',
            'Iman yang Teguh',
            'Pengampunan dan Pemulihan',
            'Hidup Kudus di Hadapan Tuhan',
            'Pelayanan dengan Hati yang Tulus',
            'Persekutuan yang Sejati'
        ];

        $catatan = [
            'Harap membawa Alkitab dan buku nyanyian',
            'Ibadah akan disiarkan langsung melalui YouTube',
            'Setelah ibadah akan ada fellowship dan makan bersama',
            'Mohon datang 15 menit sebelum ibadah dimulai',
            'Akan ada baptisan setelah khotbah',
            'Persembahan khusus untuk misi',
            'Ibadah gabungan dengan ranting lain',
            'Akan ada doa khusus untuk orang sakit',
            'Perayaan ulang tahun gereja',
            'Ibadah outdoor, mohon bawa payung jika hujan'
        ];

        // Generate random date within next 3 months
        $tanggal = $this->faker->dateTimeBetween('now', '+3 months');

        // Generate time between 06:00 and 20:00
        $waktu = $this->faker->time('H:i', '20:00');

        return [
            'nama' => $this->faker->randomElement($jenisIbadah),
            'tanggal' => $tanggal->format('Y-m-d'),
            'waktu' => $waktu,
            'lokasi' => $this->faker->randomElement($lokasi),
            'pemimpin' => $this->faker->randomElement($pemimpin),
            'pemandu' => $this->faker->optional(0.8)->randomElement($pemandu), // 80% chance to have pemandu
            'tema' => $this->faker->optional(0.7)->randomElement($tema), // 70% chance to have tema
            'catatan' => $this->faker->optional(0.6)->randomElement($catatan), // 60% chance to have catatan
            'user_id' => User::factory(), // Create a user if none exists
        ];
    }

    /**
     * Indicate that the ibadah is for Sunday morning service.
     */
    public function sundayMorning(): static
    {
        return $this->state(fn (array $attributes) => [
            'nama' => 'Ibadah Minggu Pagi',
            'waktu' => '08:00',
            'lokasi' => 'Gereja AMGPM Parthenos',
        ]);
    }

    /**
     * Indicate that the ibadah is for Sunday evening service.
     */
    public function sundayEvening(): static
    {
        return $this->state(fn (array $attributes) => [
            'nama' => 'Ibadah Minggu Sore',
            'waktu' => '17:00',
            'lokasi' => 'Gereja AMGPM Parthenos',
        ]);
    }

    /**
     * Indicate that the ibadah is for youth service.
     */
    public function youth(): static
    {
        return $this->state(fn (array $attributes) => [
            'nama' => 'Ibadah Pemuda',
            'waktu' => '19:00',
            'lokasi' => 'Aula Gereja',
            'tema' => 'Hidup dalam Terang Kristus',
        ]);
    }

    /**
     * Indicate that the ibadah is for children service.
     */
    public function children(): static
    {
        return $this->state(fn (array $attributes) => [
            'nama' => 'Ibadah Anak',
            'waktu' => '09:00',
            'lokasi' => 'Ruang Serbaguna',
            'tema' => 'Yesus Sahabat Anak-anak',
        ]);
    }

    /**
     * Indicate that the ibadah is upcoming (within next 30 days).
     */
    public function upcoming(): static
    {
        return $this->state(fn (array $attributes) => [
            'tanggal' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        ]);
    }

    /**
     * Indicate that the ibadah is today.
     */
    public function today(): static
    {
        return $this->state(fn (array $attributes) => [
            'tanggal' => Carbon::today()->format('Y-m-d'),
        ]);
    }

    /**
     * Indicate that the ibadah is in the past.
     */
    public function past(): static
    {
        return $this->state(fn (array $attributes) => [
            'tanggal' => $this->faker->dateTimeBetween('-6 months', 'yesterday')->format('Y-m-d'),
        ]);
    }

    /**
     * Indicate that the ibadah has a specific user.
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}
