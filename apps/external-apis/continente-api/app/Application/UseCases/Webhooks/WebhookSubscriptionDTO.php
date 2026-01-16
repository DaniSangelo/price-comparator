<?php

namespace App\Application\UseCases\Webhooks;

use App\Core\DTO;
use App\Domain\Entity\WebhookEntity;

class WebhookSubscriptionDTO extends DTO
{
    public string $client_id;
    public string $url;
    public string $method;
    public string $secret;
    public string $event;
    public bool $is_active;

    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    public static function fromDomain(WebhookEntity $webhook): self
    {
        return new self([
            'client_id' => $webhook->getClientId(),
            'url' => $webhook->getUrl(),
            'method' => $webhook->getMethod(),
            'secret' => $webhook->getSecret(),
            'event' => $webhook->getEvent(),
            'is_active' => $webhook->getIsActive(),
        ]);
    }
}