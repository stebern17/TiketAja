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
        User::factory()->count(5)->create();
    }
}
