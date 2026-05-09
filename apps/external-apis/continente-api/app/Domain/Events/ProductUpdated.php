<?php

namespace App\Domain\Events;

final class ProductUpdated
{
    public function __construct(
        public readonly string $productId,
        public readonly \DateTimeImmutable $updatedAt
    ) {}
}
