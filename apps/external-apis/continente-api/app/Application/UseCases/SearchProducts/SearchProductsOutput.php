<?php

namespace App\Application\UseCases\SearchProducts;

use App\Application\UseCases\SearchProducts\ProductItemDTO;

class SearchProductsOutput
{
    /**
     * @param ProductItemDTO[] $products
     */
    public function __construct(
        private array $products
    ) {}

    public function toArray(): array
    {
        return [
            'success' => true,
            'data' => array_map(fn($p) => $p->toArray(), $this->products),
        ];
    }
}
