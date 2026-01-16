<?php

namespace Database\Seeders;

use App\Infra\Persistence\Models\WebhookSubscription;
use Illuminate\Database\Seeder;

class WebhookSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebhookSubscription::factory(12)->create();
    }
}
