<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    public function run()
    {
        // Membuat 50 data ticket menggunakan factory
        Ticket::factory()->count(20)->create();
    }
}
