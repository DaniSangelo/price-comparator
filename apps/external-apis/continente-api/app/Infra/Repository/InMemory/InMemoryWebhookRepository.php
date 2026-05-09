<?php

namespace App\Infra\Repository\InMemory;

use App\Application\UseCases\Webhooks\WebhookSubscriptionInput;
use App\Domain\Contracts\Repositories\WebhookRepositoryInterface;
use App\Domain\Entity\WebhookEntity;
use Illuminate\Support\Str;

class InMemoryWebhookRepository implements WebhookRepositoryInterface
{
    private array $webhooks = [];

    public function create(WebhookSubscriptionInput $input): WebhookEntity
    {
        $webhook = new WebhookEntity(
            url: $input->url,
            method: $input->method,
            secret: $input->secret,
            event: $input->event,
            isActive: $input->is_active,
            clientId: (string) Str::uuid7(),
        );

        $this->webhooks[] = $webhook;

        return $webhook;
    }

    public function all()
    {
        return array_map(function($webhook) {
            return new WebhookEntity(
                url: $webhook->url,
                method: $webhook->method,
                secret: $webhook->secret,
                event: $webhook->event,
                isActive: $webhook->is_active,
                clientId: $webhook->id,
            );
        }, $this->webhooks);
    }
}