<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductService
{

    public function list(array $filters = []): Collection
    {
        $query = Product::query();

        // 🔹 Filtro por rango de precios
        if (!empty($filters['min_price']) && !empty($filters['max_price'])) {
            $query->whereBetween('price', [$filters['min_price'], $filters['max_price']]);
        }

        // 🔹 Ordenar por stock
        if (!empty($filters['order_by_stock']) && in_array(strtolower($filters['order_by_stock']), ['asc', 'desc'])) {
            $query->orderBy('stock', $filters['order_by_stock']);
        }

        return $query->get();
    }


    public function update(Product $product, array $data): Product
    {
        try {
            if (isset($data['stock']) && $data['stock'] < 0) {
                throw new Exception("El stock no puede ser negativo.");
            }

            $product->update($data);

            return $product;
        } catch (Exception $e) {
            throw new Exception("Error al actualizar el producto: " . $e->getMessage());
        }
    }
    public function delete(Product $product): bool
    {
        try {
            if ($product->stock > 0) {
                throw new Exception("No puedes eliminar un producto con stock disponible.");
            }

            return $product->delete();
        } catch (Exception $e) {
            throw new Exception("Error al eliminar el producto: " . $e->getMessage());
        }
    }
    public function create(array $data): Product
    {
        try {
            // Podrías agregar validaciones de negocio
            if ($data['stock'] < 0) {
                throw new Exception("El stock no puede ser negativo.");
            }

            return Product::create($data);
        } catch (Exception $e) {
            // Re-lanzamos la excepción para que el Controller la capture
            throw new Exception("Error al crear el producto: " . $e->getMessage());
        }
    }
    public function topSold(int $limit = 5)
    {
        DB::table('order_product')
            ->join('products', 'products.id', '=', 'order_product.product_id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                DB::raw('SUM(order_product.quantity) as total_vendido')
            )
            ->groupBy('products.id', 'products.name', 'products.price')
            ->orderByDesc('total_vendido')
            ->limit($limit)
            ->get();


    }
    
}
