<?php

namespace App\Application\UseCases\Webhooks;

class WebhookSubscriptionOutput
{
    public function __construct(
        public array $webhookSubscription
    ) {}

    public function toArray(): array
    {
        return [
            'success' => true,
            'data' => $this->webhookSubscription
        ];
    }
}