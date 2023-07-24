<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_buku' => $this->faker->unique()->randomNumber(5, true),
            'nama_buku' => $this->faker->words(2, true),
            'penerbit' => $this->faker->name,
            'th_terbit' => $this->faker->date('Y'),
            'isbn' => $this->faker->randomNumber(5, true),
            'kategori_id' => '1',
            'kondisi_buku_baik' => $this->faker->randomDigitNotNull(),
            'kondisi_buku_rusak' => $this->faker->randomDigitNotNull(),
            'foto_buku' => null,
        ];
    }
}
