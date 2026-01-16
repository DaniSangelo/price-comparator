<?php

namespace App\Application\UseCases\SearchProducts;

use App\Domain\Contracts\Repositories\ProductRepositoryInterface;

class SearchProductsUseCase
{
    public function __construct(private ProductRepositoryInterface $productRepository) {}

    public function execute(SearchProductsInput $input): SearchProductsOutput
    {
        $items = $this->productRepository->search(query: $input->query(), page: $input->page());

        $items = array_map(
            fn($product) => ProductItemDTO::fromDomain($product),
            $items
        );

        return new SearchProductsOutput(products: $items);
    }
}