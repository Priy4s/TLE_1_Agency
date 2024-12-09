<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\quiz;

class QuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quiz::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->word(),
            'points' => $this->faker->numberBetween(-10000, 10000),
            'user_id' => $this->faker->word(),
            'belongsTo' => $this->faker->word(),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
