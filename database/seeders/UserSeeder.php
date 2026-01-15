<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            "name" => "Maged Yaseen",
            "email" => "magedyaseengroups@gmail.com",
            "password" => "password",
            "roles" => "admin",
            "phone" => "01024750245",
            "profile_photo" => "https://lh3.googleusercontent.com/ogw/AF2bZyjJlDe8S7dkN0oXZM1wrtyrmNpFhsNfNQPT9No7qWD0KQ=s32-c-mo",
        ]);

        User::factory(1000)->create();
    }
}
