<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        // Daftar kota yang spesifik
        $cityList = ['Yogyakarta', 'Solo', 'Semarang'];

        // Daftar venue yang spesifik
        $venueList = ['Gedung Balai', 'Gedung Wiratama', 'Balairung', 'Boulevard'];

        // Mengambil kota dan venue secara acak
        $location = $this->faker->randomElement($cityList); // Kota
        $venue = $this->faker->randomElement($venueList); // Nama tempat atau venue

        // Menggabungkan location dan venue
        $locationAndVenue = $location . ', ' . $venue;

        return [
            'name' => $this->faker->word(),
            'date' => $this->faker->date(),
            'image' => $this->faker->imageUrl(),
            'location' => $locationAndVenue,  // Kolom location yang sudah digabungkan
            'description' => $this->faker->paragraph(),
            'capacity' => $this->faker->numberBetween(50, 1000),
            'status' => $this->faker->randomElement(['Ongoing', 'Upcoming', 'Done']),
        ];
    }
}