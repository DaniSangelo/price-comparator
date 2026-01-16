<?php

namespace App\Domain\Entity;

class WebhookEntity
{
    public function __construct(
        private string $clientId,
        private string $url,
        private string $method,
        private string $secret,
        private string $event,
        private bool $isActive,
    ) {}

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }
}