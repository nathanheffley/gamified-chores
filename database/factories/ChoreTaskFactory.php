<?php

namespace Database\Factories;

use App\Models\Chore;
use App\Models\ChoreTask;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChoreTaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChoreTask::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'chore_id' => Chore::factory(),
        ];
    }
}
