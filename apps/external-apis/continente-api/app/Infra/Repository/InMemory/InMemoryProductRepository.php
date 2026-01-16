<?php

namespace App\Infra\Repository\InMemory;

use App\Domain\Contracts\Repositories\ProductRepositoryInterface;
use App\Domain\Entity\ProductEntity;

class InMemoryProductRepository implements ProductRepositoryInterface
{
    /**
     * @param ProductEntity[] $items
    */
    public function __construct(
        private array $items = [],
        private int $perPage = 20
    ) {}

    /**
     * @return ProductEntity[]
     */
    public function search(?string $query, int $page): array
    {
        $page = max(1, $page);
        $query = $query ? trim($query) : null;

        $filtered = $this->items;

        if (!empty($query)) {
            $q = mb_strtolower($query);

            $filtered = array_values(array_filter($filtered, function (ProductEntity $p) use ($q) {
                return str_contains(mb_strtolower($p->name()), $q);
            }));
        }

        $offset = ($page - 1) * $this->perPage;

        return array_slice($filtered, $offset, $this->perPage);
    }
}