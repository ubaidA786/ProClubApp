<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Faker\Provider\Youtube($faker));
        return [
            'title' => $this->faker->company,
            'url' => $faker->youtubeUri(),
            'description' => $this->faker->paragraph,
            'status' => 1,
        ];
    }
}
