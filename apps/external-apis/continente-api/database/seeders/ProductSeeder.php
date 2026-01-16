<?php

namespace Database\Seeders;

use App\Infra\Persistence\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->count(520)->create();
    }
}
