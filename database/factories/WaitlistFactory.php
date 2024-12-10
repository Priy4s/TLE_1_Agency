<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\waitlist;

class WaitlistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Waitlist::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'job_id' => $this->faker->numberBetween(-10000, 10000),
            'belongsTo' => $this->faker->word(),
            'user_id' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->word(),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
