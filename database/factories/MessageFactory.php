<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'from_id' => $this->faker->numberBetween(1, 10),
            'to_id' => $this->faker->numberBetween(1, 10),
            'body' => $this->faker->sentence,
            'attachment' => $this->faker->imageUrl(),
        ];
    }
}
