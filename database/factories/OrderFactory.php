<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'id_user' => User::inRandomOrder()->first()->id, // Ambil ID user secara acak
            'id_event' => Event::inRandomOrder()->first()->id_event, // Ambil ID event secara acak
            'ticket_code' => $this->faker->unique()->randomNumber(5), // Menghasilkan kode tiket acak
            'payment_proof' => $this->faker->imageUrl(640, 480, 'business'), // Menghasilkan URL gambar acak untuk bukti pembayaran
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']), // Pilih status acak
            'quantity' => $this->faker->numberBetween(1, 10), // Jumlah tiket yang dipesan
            'total_price' => $this->faker->numberBetween(100, 1000), // Harga total acak
            'transaction' => $this->faker->unique()->uuid(), // Nomor transaksi acak
        ];
    }
}
