<?php

namespace App\Infra\Http\Controllers;

use App\Application\UseCases\ProductUpdate\ProductUpdateUseCase;
use App\Application\UseCases\ProductUpdate\UpdateProductInput;
use App\Application\UseCases\SearchProducts\SearchProductsInput;
use App\Application\UseCases\SearchProducts\SearchProductsUseCase;
use App\Infra\Http\Requests\SearchProductsRequest;
use App\Infra\Http\Requests\UpdateProductRequest;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct(private SearchProductsUseCase $searchProductsUseCase, private ProductUpdateUseCase $productUpdateUseCase) {}

    public function index(SearchProductsRequest $request)
    {
        try {
            logger()->info('Start search products', $request->validated());
            $input = new SearchProductsInput($request->validated());
            $output = $this->searchProductsUseCase->execute($input);
            logger()->info('End search products', ['total' => $output->count()]);
            return response()->json($output->toArray(), Response::HTTP_OK);
        } catch (\Exception $e) {
            logger()->error('Error search products', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateProductRequest $request)
    {
        $input = new UpdateProductInput($request->validated());
        $this->productUpdateUseCase->execute($input);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
