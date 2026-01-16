<?php

namespace App\Infra\Repository\Eloquent;

use App\Domain\Contracts\Repositories\ProductRepositoryInterface;
use App\Domain\Entity\ProductEntity;
use App\Infra\Persistence\Models\Product;

class EloquentProductRepository implements ProductRepositoryInterface
{

    public function search(?string $query, int $page): array
    {
        $page = max(1, min($page, 200));

        /** @var \Illuminate\Database\Eloquent\Builder $builder */
        $builder = Product::query()
            ->select([
                'external_id',
                'name',
                'category',
                'price_cents',
                'currency',
                'available',
            ])
            ->where('available', true);

        if (!empty($query)) {
            $query = trim($query);

            $builder->where('name', 'like', '%' . $query . '%');
        }

        $rows = $builder
            ->orderBy('name', 'asc')
            ->paginate($page);

        return $rows->map(function ($row) {
            return new ProductEntity(
                    externalId: $row->external_id,
                    name: $row->name,
                    category: $row->category,
                    priceCents: (float) $row->price_cents,
                    currency: $row->currency,
                    available: (bool) $row->available
            );
        })->all();
    }
}
