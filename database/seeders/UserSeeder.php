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
            'email' => 'admin@amgpm.com',
            'password' => bcrypt('admin@amgpm.com'),
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'golongan_darah' => 'O',
            'whatsapp' => '6281318812027',
            'is_admin' => true
        ]);

        // Create regular user
        \App\Models\User::factory()->create([
            'nama' => 'User Biasa',
            'email' => 'user@amgpm.com',
            'password' => bcrypt('user@amgpm.com'),
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1995-01-01',
            'golongan_darah' => 'A',
            'whatsapp' => '6281318812028',
            'is_admin' => false
        ]);

        // Create additional regular users
        \App\Models\User::factory(8)->create(['is_admin' => false]);
    }
}
