<?php

namespace Database\Factories\Infra\Persistence\Models;

use Database\Factories\ProductFakeDataHelper;
use App\Infra\Persistence\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Infra\Persistence\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = ProductFakeDataHelper::getRandomProduct();
        return [
            'external_id' => 'CNT-' . $this->faker->unique()->numberBetween(1000, 999999),
            'name'        => $product['name'],
            'category'    => $product['category'],
            'price_cents' => $this->faker->randomFloat(2, 0.5, 299.99),
            'currency' => 'EUR',
            'available' => $this->faker->boolean(92),
        ];
    }
}
