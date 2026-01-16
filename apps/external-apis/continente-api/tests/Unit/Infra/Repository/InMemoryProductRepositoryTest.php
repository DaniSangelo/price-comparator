<?php

namespace Tests\Unit\Infra\Repository;

use App\Domain\Entity\ProductEntity;
use App\Infra\Repository\InMemory\InMemoryProductRepository;
use Tests\TestCase;

class InMemoryProductRepositoryTest extends TestCase
{
    public function test_it_filters_by_query(): void
    {
        $repo = new InMemoryProductRepository(items: [
            new ProductEntity('CNT-1', 'Leite Meio-Gordo 1L', 'Laticínios', 100, 'EUR', true),
            new ProductEntity('CNT-2', 'Chocolate', 'Snacks', 200, 'EUR', true),
        ], perPage: 20);

        $result = $repo->search('leite', 1);

        $this->assertCount(1, $result);
        $this->assertEquals('Leite Meio-Gordo 1L', $result[0]->name());
    }

    public function test_it_paginates_items(): void
    {
        $items = [];

        for ($i = 1; $i <= 25; $i++) {
            $items[] = new ProductEntity("CNT-$i", "Leite Meio-Gordo $i", null, 100, 'EUR', true);
        }

        $repo = new InMemoryProductRepository(items: $items, perPage: 20);

        $page1 = $repo->search(null, 1);
        $page2 = $repo->search(null, 2);

        $this->assertCount(20, $page1);
        $this->assertCount(5, $page2);
        $this->assertEquals('Leite Meio-Gordo 1', $page1[0]->name());
        $this->assertEquals('Leite Meio-Gordo 21', $page2[0]->name());
    }
}
