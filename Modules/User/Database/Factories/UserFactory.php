<?php

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\FileManager\App\Helpers\ImageHelper;
use Modules\User\App\Helpers\UserHelper;
use Modules\User\App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\User\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name,
            'username' => UserHelper::createDefaultUsername(),
            'email' => fake()->unique()->safeEmail,
            'bio' => fake()->sentence,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'status' => fake()->boolean,
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

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => true,
        ]);
    }

    public function configure(): Factory
    {
        return $this->afterCreating(function (User $user) {
            $defaultImage = UserHelper::createDefaultProfilePicture();
            $user->image()->save($defaultImage);
        });
    }
}
