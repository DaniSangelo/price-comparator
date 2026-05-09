<?php

namespace App\Domain\Contracts\Repositories;

use App\Application\UseCases\Webhooks\WebhookSubscriptionInput;
use App\Domain\Entity\WebhookEntity;

interface WebhookRepositoryInterface
{
    public function create(WebhookSubscriptionInput $input): WebhookEntity;
    public function all();
    // public function update(WebhookSubscriptionInput $input): void;
    // public function delete(string $clientId): void;
}