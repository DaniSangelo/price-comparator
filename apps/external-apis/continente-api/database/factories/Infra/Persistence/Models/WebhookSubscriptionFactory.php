<?php

namespace Database\Factories\Infra\Persistence\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Infra\Persistence\Models\WebhookSubscription>
 */
class WebhookSubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Infra\Persistence\Models\WebhookSubscription::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Str::uuid7(),
            'url' => $this->faker->url(),
            'method' => $this->faker->randomElement(['POST', 'GET', 'PUT']),
            'secret' => $this->faker->md5(),
            'event' => $this->faker->randomElement(['product.created', 'product.updated', 'product.deleted']),
            'is_active' => $this->faker->boolean(70),
        ];
    }
}
