<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'name' => $this->faker->name(),
            'title' => $this->faker->sentence,
            'slug' => str::slug($this->faker->sentence),
            'description' => $this->faker->text($maxNbChars = 300),
            'publication_date' => $this->faker->datetime(),
            'published' => 1,
        ];
    }

    public function unpublished()
    {
        return $this->state(function (array $attributes) {
            return [
                'published' => 0,
            ];
        });
    }
}
