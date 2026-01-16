<?php

namespace App\Infra\Http\Controllers;

use App\Application\UseCases\SearchProducts\SearchProductsInput;
use App\Application\UseCases\SearchProducts\SearchProductsUseCase;
use App\Infra\Http\Requests\SearchProductsRequest;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(private SearchProductsUseCase $searchProductsUseCase) {}

    public function index(SearchProductsRequest $request)
    {
        try {
            logger()->info('Start search products', $request->validated());
            $input = new SearchProductsInput($request->validated());
            $output = $this->searchProductsUseCase->execute($input);
            $clone = clone $output;
            logger()->info('End search products', array_slice($clone->toArray(), 0, 10));
            return response()->json($output->toArray(), Response::HTTP_OK);
        } catch (\Exception $e) {
            logger()->error('Error search products', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
