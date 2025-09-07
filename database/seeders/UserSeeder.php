<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('admin@amgpm.test'),
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2001-01-14',
            'jenis_kelamin' => 'L',
            'golongan_darah' => 'O',
            'whatsapp' => '62648254825482',
            'is_admin' => true
        ]);

        // Create admin user
        \App\Models\User::factory()->create([
            'nama' => 'Marthin Alfreinsco Salakory',
            'email' => 'alfreinsco@gmail.com',
            'password' => Hash::make('20010114'),
            'tempat_lahir' => 'Wassu',
            'tanggal_lahir' => '2001-01-14',
            'jenis_kelamin' => 'L',
            'golongan_darah' => 'O',
            'whatsapp' => '6281318812027',
            'is_admin' => true
        ]);

        // Create regular user
        \App\Models\User::factory()->create([
            'nama' => 'User Biasa',
            'email' => 'user@amgpm.test',
            'password' => Hash::make('user@amgpm.test'),
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2001-01-14',
            'jenis_kelamin' => 'L',
            'golongan_darah' => 'O',
            'whatsapp' => '6281248808575',
            'is_admin' => false
        ]);

        // Create regular user
        \App\Models\User::factory()->create([
            'nama' => 'Joseph Reasoa',
            'email' => 'joseph@amgpm.test',
            'password' => Hash::make('20010206'),
            'tempat_lahir' => 'Ambon',
            'tanggal_lahir' => '2001-02-06',
            'jenis_kelamin' => 'L',
            'golongan_darah' => 'O',
            'whatsapp' => '6282198210191',
            'is_admin' => false
        ]);

        // Create additional regular users
        \App\Models\User::factory(200)->create(['is_admin' => false]);
    }
}
