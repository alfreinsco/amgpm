<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        \App\Models\User::factory()->create([
            'nama' => 'Admin AMGPM',
            'email' => 'admin@amgpm.test',
            'password' => bcrypt('admin@amgpm.test'),
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2001-01-14',
            'golongan_darah' => 'O',
            'whatsapp' => '6281318812027',
            'is_admin' => true
        ]);

        // Create regular user
        \App\Models\User::factory()->create([
            'nama' => 'User Biasa',
            'email' => 'user@amgpm.test',
            'password' => bcrypt('user@amgpm.test'),
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2001-01-14',
            'golongan_darah' => 'O',
            'whatsapp' => '6281248808575',
            'is_admin' => false
        ]);

        // Create additional regular users
        \App\Models\User::factory(200)->create(['is_admin' => false]);
    }
}
