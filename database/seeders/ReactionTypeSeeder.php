<?php

namespace Database\Seeders;

use App\Models\ReactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'like',
            'love',
            'happy',
            'sad',
            'angry',
            'laugh',
            'surprise',
            'dislike',
            'tear',
            'care'
        ];
        
        foreach ($types as $type) {
            ReactionType::factory()->create([
                'type' => $type,
            ]);
        }
    }
}
