<?php

namespace App\Infra\Messaging\Consumers;

use App\Domain\Contracts\HttpClientInterface;
use App\Domain\Contracts\Repositories\WebhookRepositoryInterface;
use App\Domain\Events\ProductUpdated;

class ProductUpdatedConsumer
{
    public function __construct(private WebhookRepositoryInterface $webhookRepository, private HttpClientInterface $httpClient) {}

    public function __invoke(ProductUpdated $event): void
    {
        $subscriptions = $this->webhookRepository->all();

        foreach ($subscriptions as $subscription) {
            $this->httpClient->post(
                $subscription->url,
                [
                    'headers' => [
                        'X-Webhook-Key' => $subscription->key,
                    ],
                    'json' => [
                        'product_id' => $event->productId,
                        'updated_at' => $event->updatedAt->format(DATE_ATOM),
                    ],
                ]
            );
        }
    }
}