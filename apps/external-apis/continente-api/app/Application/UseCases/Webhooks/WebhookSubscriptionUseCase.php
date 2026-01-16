<?php

namespace App\Application\UseCases\Webhooks;

use App\Domain\Contracts\Repositories\WebhookRepositoryInterface;

class WebhookSubscriptionUseCase
{
    public function __construct(
        private WebhookRepositoryInterface $webhookRepository,
    ) {}

    public function execute(WebhookSubscriptionInput $input)
    {
        $webhook = $this->webhookRepository->create($input);
        $webhookDTO = WebhookSubscriptionDTO::fromDomain($webhook);
        return new WebhookSubscriptionOutput($webhookDTO->toArray());
    }
}