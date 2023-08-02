<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitor>
 */
class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = date('Y');
        return [
            'nama' => $this->faker->name(),
            'kelas' => 'X TKJ 1',
            'nis' => $this->faker->randomDigit(18, true),
            'keperluan' => $this->faker->randomElement(['Baca Buku', 'Pinjam Buku', 'Lainnya']),
            'created_at' => $this->faker->dateTimeBetween("$year-01-01 00:00:00", "$year-12-31 23:59:59")->format('Y-m-d H:i:s'),
        ];
    }
}
