<?php

namespace Database\Seeders;

use App\Models\Ibadah;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(class: [
            UserSeeder::class,
        ]);

        // Generate 300 jadwal ibadah random
        Ibadah::factory(300)->create();

        // Generate ibadah minggu pagi
        Ibadah::factory()->sundayMorning()->create();

        // Generate ibadah untuk user tertentu
        // Ibadah::factory()->forUser($user)->create();
    }
}
