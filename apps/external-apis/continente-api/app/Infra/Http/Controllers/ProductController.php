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

            $input = new SearchProductsInput($request->validated());
            $output = $this->searchProductsUseCase->execute($input);
    
            return response()->json($output->toArray(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
