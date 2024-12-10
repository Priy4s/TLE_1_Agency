<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\profile;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(-10000, 10000),
            'belongsTo' => $this->faker->word(),
            'quiz_result' => $this->faker->numberBetween(-10000, 10000),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
