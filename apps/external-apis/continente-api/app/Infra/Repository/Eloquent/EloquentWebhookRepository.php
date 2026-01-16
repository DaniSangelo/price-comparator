<?php

namespace App\Infra\Repository\Eloquent;

use App\Application\UseCases\Webhooks\WebhookSubscriptionInput;
use App\Domain\Contracts\Repositories\WebhookRepositoryInterface;
use App\Domain\Entity\WebhookEntity;
use App\Infra\Persistence\Models\WebhookSubscription;

class EloquentWebhookRepository implements WebhookRepositoryInterface
{
    public function create(WebhookSubscriptionInput $input): WebhookEntity
    {
        $webhookSubscription = WebhookSubscription::create($input->toArray());
        return new WebhookEntity(
            $webhookSubscription->client_id,
            $webhookSubscription->url,
            $webhookSubscription->method,
            $webhookSubscription->secret,
            $webhookSubscription->event,
            $webhookSubscription->is_active,
        );
    }
}