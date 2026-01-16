<?php

namespace App\Application\UseCases\Webhooks;

use App\Core\DTO;

class WebhookSubscriptionInput extends DTO
{
    public string $url;
    public string $method;
    public string $secret;
    public string $event;
    public bool $is_active;

    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
