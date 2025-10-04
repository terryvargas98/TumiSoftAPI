<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Exception;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }
    public function index(ProductFilterRequest $request): JsonResponse
    {
        try {
            $filters = $request->validated();
            $products = $this->service->list($filters);

            return response()->json([
                'error' => false,
                'message' => 'Lista de productos',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function store(ProductCreateRequest $request): JsonResponse
    {
        try {
            $product = $this->service->create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Producto creado correctamente',
                'data' => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
            Log::error('Error al crear producto: ' . $e->getMessage());
        }
    }
    public function update(ProductUpdateRequest $request, Product $product): JsonResponse
    {
        try {
            $updated = $this->service->update($product, $request->validated());

            return response()->json([
                'error' => false,
                'message' => 'Producto actualizado correctamente',
                'data' => $updated
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy(Product $product): JsonResponse
    {
        try {
            $this->service->delete($product);

            return response()->json([
                'error' => false,
                'message' => 'Producto eliminado correctamente'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function topSold(): JsonResponse
    {
        try {
            $topProducts =  $this->service->topSold();

            return response()->json([
                'error' => false,
                'message' => 'Top 5 productos más vendidos',
                'data' => $topProducts

            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
