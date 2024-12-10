<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\job_listing;

class JobListingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobListing::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'position' => $this->faker->word(),
            'description' => $this->faker->text(),
            'length' => $this->faker->numberBetween(-10000, 10000),
            'hours' => $this->faker->numberBetween(-10000, 10000),
            'minutes' => $this->faker->numberBetween(-10000, 10000),
            'salary' => $this->faker->randomFloat(0, 0, 9999999999.),
            'type' => $this->faker->word(),
            'location_id' => $this->faker->numberBetween(-10000, 10000),
            'location' => $this->faker->word(),
            'image' => $this->faker->text(),
            'video' => $this->faker->word(),
            'company_id' => $this->faker->numberBetween(-10000, 10000),
            'company' => $this->faker->company(),
            'needed' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
