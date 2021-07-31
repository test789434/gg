<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Support\Str;

class UserFactory extends \Orchestra\Testbench\Factories\UserFactory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'id' => 1,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ];
    }
}
