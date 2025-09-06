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
        \App\Models\User::factory()->create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@gmail.com'),
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'golongan_darah' => 'O',
            'whatsapp' => '6281318812027'
        ]);

        \App\Models\User::factory(10)->create();
    }
}
