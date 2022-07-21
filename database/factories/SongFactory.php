<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'artist' => $this->faker->name,
            'lyrics' => $this->faker->paragraph,
            'bpm' => $this->faker->numberBetween(80, 160),
            'song_key' => $this->faker->randomElement(['C', 'D#m', 'F#m', 'Am', 'Em', 'G']),
            'team_id' => Team::factory(),
        ];
    }
}
