<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Anime;

class DatabaseSeeder extends Seeder
{
	protected array $animeList = [
		['mal_id' => 16498, 'title' => 'Attack on Titan', 'genre' => 'Action', 'episodes' => 87, 'status' => 'Completed', 'rating' => 10, 'studio' => 'MAPPA'],
		['mal_id' => 38000, 'title' => 'Demon Slayer', 'genre' => 'Action', 'episodes' => 26, 'status' => 'Completed', 'rating' => 9, 'studio' => 'Ufotable'],
		['mal_id' => 5114, 'title' => 'Fullmetal Alchemist: Brotherhood', 'genre' => 'Fantasy', 'episodes' => 64, 'status' => 'Completed', 'rating' => 10, 'studio' => 'Bones'],
		['mal_id' => 40748, 'title' => 'Jujutsu Kaisen', 'genre' => 'Action', 'episodes' => 48, 'status' => 'Watching', 'rating' => 9, 'studio' => 'MAPPA'],
		['mal_id' => 31240, 'title' => 'Re:Zero', 'genre' => 'Isekai', 'episodes' => 50, 'status' => 'Completed', 'rating' => 9, 'studio' => 'Wit Studio'],
		['mal_id' => 11757, 'title' => 'Sword Art Online', 'genre' => 'Isekai', 'episodes' => 25, 'status' => 'Completed', 'rating' => 7, 'studio' => 'A-1 Pictures'],
		['mal_id' => 21, 'title' => 'One Piece', 'genre' => 'Action', 'episodes' => 1000, 'status' => 'Watching', 'rating' => 9, 'studio' => 'Toei Animation'],
		['mal_id' => 23273, 'title' => 'Your Lie in April', 'genre' => 'Romance', 'episodes' => 22, 'status' => 'Completed', 'rating' => 10, 'studio' => 'A-1 Pictures'],
		['mal_id' => 20583, 'title' => 'Haikyuu!!', 'genre' => 'Sports', 'episodes' => 85, 'status' => 'Completed', 'rating' => 9, 'studio' => 'Production I.G'],
		['mal_id' => 30, 'title' => 'Neon Genesis Evangelion', 'genre' => 'Mecha', 'episodes' => 26, 'status' => 'Completed', 'rating' => 9, 'studio' => 'Gainax'],
		['mal_id' => 44511, 'title' => 'Chainsaw Man', 'genre' => 'Action', 'episodes' => 12, 'status' => 'Completed', 'rating' => 9, 'studio' => 'MAPPA'],
		['mal_id' => 50265, 'title' => 'Spy x Family', 'genre' => 'Slice of Life', 'episodes' => 25, 'status' => 'Completed', 'rating' => 9, 'studio' => 'Wit Studio'],
		['mal_id' => 918, 'title' => 'Gintama', 'genre' => 'Action', 'episodes' => 201, 'status' => 'Completed', 'rating' => 9, 'studio' => 'Sunrise'],
		['mal_id' => 1535, 'title' => 'Death Note', 'genre' => 'Horror', 'episodes' => 37, 'status' => 'Completed', 'rating' => 10, 'studio' => 'Madhouse'],
		['mal_id' => 22319, 'title' => 'Tokyo Ghoul', 'genre' => 'Horror', 'episodes' => 12, 'status' => 'Completed', 'rating' => 8, 'studio' => 'Pierrot'],
		['mal_id' => 34572, 'title' => 'Black Clover', 'genre' => 'Fantasy', 'episodes' => 170, 'status' => 'Completed', 'rating' => 8, 'studio' => 'Pierrot'],
		['mal_id' => 9253, 'title' => 'Steins;Gate', 'genre' => 'Slice of Life', 'episodes' => 24, 'status' => 'Completed', 'rating' => 10, 'studio' => 'White Fox'],
		['mal_id' => 32182, 'title' => 'Mob Psycho 100', 'genre' => 'Action', 'episodes' => 12, 'status' => 'Completed', 'rating' => 9, 'studio' => 'Bones'],
		['mal_id' => 11061, 'title' => 'Hunter x Hunter', 'genre' => 'Action', 'episodes' => 148, 'status' => 'Plan to Watch', 'rating' => 10, 'studio' => 'Madhouse'],
		['mal_id' => 32281, 'title' => 'Kimi no Na wa', 'genre' => 'Romance', 'episodes' => 1, 'status' => 'Completed', 'rating' => 10, 'studio' => 'CoMix Wave Films'],
	];

	public function run(): void
	{
		foreach ($this->animeList as $item) {
			$coverImage = null;

			try {
				// small delay to avoid Jikan rate limiting (causes NULLs)
				usleep(500000); // 0.5 seconds

				$response = Http::withoutVerifying()
					->timeout(10)
					->get("https://api.jikan.moe/v4/anime/{$item['mal_id']}");

				if ($response->successful()) {
					$coverImage = $response->json('data.images.jpg.large_image_url');
				}
			} catch (\Exception $e) {
			}

			Anime::create([
				'title' => $item['title'],
				'genre' => $item['genre'],
				'episodes' => $item['episodes'],
				'status' => $item['status'],
				'rating' => $item['rating'],
				'studio' => $item['studio'],
				'cover_image' => $coverImage,
			]);
		}
	}
}