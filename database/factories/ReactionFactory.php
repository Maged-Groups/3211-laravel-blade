<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\ReactionType;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reaction>
 */
class ReactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'Post',
            'Comment',
            'Reply',
        ];

        $randomType = $this->faker->randomElement($types);
        $reactable_type = 'App\Models\\' . $randomType;

        $reactable_id = match ($randomType) {
            'Post' => Post::inRandomOrder()->first()->id,
            'Comment' => Comment::inRandomOrder()->first()->id,
            'Reply' => Reply::inRandomOrder()->first()->id,
        };

        $user_id = User::inRandomOrder()->first()->id;

        $exists = Reaction
            ::where('user_id', $user_id)
            ->where('reactable_id', $reactable_id)
            ->where('reactable_type', $reactable_type)
            ->first();

        if (!$exists) {
            return [
                'reactable_id' => $reactable_id,  
                'reactable_type' => $reactable_type,  
                'user_id' => $user_id,  
                'reaction_type' => ReactionType::inRandomOrder()->first()->id,
            ];
        }
        return [];
    }
}
