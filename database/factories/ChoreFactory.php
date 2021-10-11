<?php

namespace Database\Factories;

use App\Models\Chore;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chore::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'points' => $this->faker->randomNumber(2),
            'photo' => $this->faker->imageUrl(),
        ];
    }
}
