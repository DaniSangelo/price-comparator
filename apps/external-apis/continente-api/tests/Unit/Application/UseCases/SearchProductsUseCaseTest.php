<?php

namespace Tests\Unit\Application\UseCases;

use App\Application\UseCases\SearchProducts\SearchProductsInput;
use App\Application\UseCases\SearchProducts\SearchProductsUseCase;
use App\Domain\Contracts\Repositories\ProductRepositoryInterface;
use App\Domain\Entity\ProductEntity;
use Mockery;
use Tests\TestCase;

class SearchProductsUseCaseTest extends TestCase
{
    public function test_it_returns_products_mapped_as_output_dtos(): void
    {
        $repo = Mockery::mock(ProductRepositoryInterface::class);

        $repo->shouldReceive('search')
            ->once()
            ->with('milk', 1)
            ->andReturn(
                new ProductEntity(
                    externalId: 'CNT-001',
                    name: 'Leite Meio-Gordo 1L',
                    category: 'Laticínios',
                    priceCents: 109.20,
                    currency: 'EUR',
                    available: true
                )
            );

        $useCase = new SearchProductsUseCase($repo);
        $input = new SearchProductsInput(['query' => 'milk', 'page' => 1]);
        $output = $useCase->execute($input);

        $array = $output->toArray();

        $this->assertCount(1, $array['data']);
        $this->assertEquals('CNT-001', $array['data'][0]['external_id']);
        $this->assertEquals('Leite Meio-Gordo 1L', $array['data'][0]['name']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
