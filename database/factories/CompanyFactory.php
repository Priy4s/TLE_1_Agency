<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Company;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'location_id' => $this->faker->numberBetween(-10000, 10000),
            'location' => $this->faker->word(),
            'image' => $this->faker->text(),
            'video' => $this->faker->word(),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
