<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'pendidikan' => $this->faker->randomElement(['SMA', 'D3', 'S1', 'S2', 'S3']),
            'tanggal_lahir' => $this->faker->date(),
        ];
    }
}
