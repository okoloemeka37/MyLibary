<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $img=['f.jpg','f2.jpg','front.jpg','grid.jpg','im.jpg','penny.jpg'];
        $fi=rand(0,5);
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('Secret'),
            'remember_token' => Str::random(10),
            'image'=>$img[$fi],
            'role'=>'Author',
            'phone'=>fake()->phoneNumber(),
            'author_description'=>fake()->text(),
            'fb_link'=>fake()->url(),
            'ig_link'=>fake()->url(),
            'twitter_link'=>fake()->url(),
            'country'=>fake()->country(),
            'currency'=>fake()->currencyCode(),
            'liked_genres'=>json_encode(['Romance']),
            'liked_topics'=>json_encode(['Romance'])
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
