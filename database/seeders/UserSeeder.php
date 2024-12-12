<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk mengisi data tiket.
     *
     * @return void
     */
    public function run()
    {
        // Menggunakan factory untuk membuat 50 data tiket
        User::factory()->create([
            'name_user' => 'Admin',
            'email_user' => 'admin@gmail.com',
            'role' => 'Admin'
        ]);

        User::factory()->count(5)->create([
            'role' => 'User'
        ]);
    }
}
