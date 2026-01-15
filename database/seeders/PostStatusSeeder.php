<?php

namespace Database\Seeders;

use App\Models\PostStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'pending',
            'published',
            'archived',
            'deleted',
            'hidden',
            'cancelled',
            'postponed'
        ];

        foreach ($types as $type) {
            PostStatus::factory()->create([
                'type' => $type,
            ]);
        }
    }
}
