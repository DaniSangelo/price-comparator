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

    public function products(): array
    {
        return $this->products;
    }

    public function count(): int
    {
        return count($this->products);
    }
}
