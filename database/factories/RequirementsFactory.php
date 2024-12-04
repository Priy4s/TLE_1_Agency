<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\requirements;

class RequirementsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Requirements::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'job_id' => $this->faker->numberBetween(-10000, 10000),
            'belongsTo' => $this->faker->word(),
            'drivers_license' => $this->faker->boolean(),
            'walking' => $this->faker->boolean(),
            'hands' => $this->faker->boolean(),
            'standing' => $this->faker->boolean(),
            'talking' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
