<?php

declare(strict_types=1);

namespace Database\Factories;

use GoldenGoose\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition(): array
    {
        return [
            'id' => 1,
            'title' => $this->faker->realText(mt_rand(0, 100))
        ];
    }
}
