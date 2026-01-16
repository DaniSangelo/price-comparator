<?php

namespace App\Domain\Entity;

class ProductEntity
{
    public function __construct(
        private string $externalId,
        private string $name,
        private ?string $category,
        private int $priceCents,
        private string $currency,
        private bool $available
    ) {}

    public function externalId(): string
    {
        return $this->externalId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function category(): ?string
    {
        return $this->category;
    }

    public function priceCents(): int
    {
        return $this->priceCents;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function available(): bool
    {
        return $this->available;
    }
}
