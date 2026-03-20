<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anime>
 */
class AnimeFactory extends Factory
{
	public function definition(): array
	{
		return [
			'title' => $this->faker->words(3, true),
			'genre' => $this->faker->randomElement(['Action', 'Romance', 'Isekai', 'Fantasy', 'Slice of Life', 'Horror', 'Sports', 'Mecha']),
			'episodes' => $this->faker->numberBetween(1, 100),
			'status' => $this->faker->randomElement(['Watching', 'Completed', 'Plan to Watch', 'Dropped']),
			'rating' => $this->faker->numberBetween(1, 10),
			'studio' => $this->faker->randomElement(['Mappa', 'Ufotable', 'Bones', 'Wit Studio', 'A-1 Pictures', 'Toei Animation']),
			'cover_image' => 'https://picsum.photos/seed/' . $this->faker->word() . '/300/400',
		];
	}
}