<?php

namespace App\Domain\Contracts\Repositories;

use App\Domain\Entity\ProductEntity;

interface ProductRepositoryInterface
{
    /**
     * @return ProductEntity[]
    */
    public function search(?string $query, int $page): array;
}