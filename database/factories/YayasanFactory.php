<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class YayasanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->company(),
            'alamat' => $this->faker->address(),
            'telp' => $this->faker->phoneNumber(),
        ];
    }
}
