<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PointIt>
 */
class PointItFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->text(),
            'img' => $this->faker->image('public/img/', 400, 300, null, false),
            'user_id' => $this->faker->numberBetween(1,10),
            'group_id' => $this->faker->numberBetween(1,5),
        ];
    }
}
