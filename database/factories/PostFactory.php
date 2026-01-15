<?php

namespace Database\Factories;

use App\Models\PostStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randNum = rand(1, 1000);

        return [
            'post_title' => $this->faker->text(),
            'post_body' => $this->faker->paragraph(),
            'thumbnail' => "https://picsum.photos/id/$randNum/600/600",
            'user_id' => User::all()->random()->id,
            'post_status_id' => PostStatus::inRandomOrder()->first()->id,
        ];
    }
}
