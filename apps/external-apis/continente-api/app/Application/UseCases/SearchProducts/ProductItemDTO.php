<?php

namespace App\Application\UseCases\SearchProducts;

use App\Core\DTO;
use App\Domain\Entity\ProductEntity;

class ProductItemDTO extends DTO
{
    public string $external_id;
    public string $name;
    public ?string $category;
    public float $price_cents;
    public string $currency;
    public bool $available;

    public function __construct(array $data) {
        parent::__construct($data);
    }

    public static function fromDomain(ProductEntity $product): self
    {
        return new self([
            'external_id' => $product->externalId(),
            'name' => $product->name(),
            'category' => $product->category(),
            'price_cents' => $product->priceCents(),
            'currency' => $product->currency(),
            'available' => $product->available()
        ]);
    }
}
