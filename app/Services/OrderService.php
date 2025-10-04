<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Jobs\GenerateOrderReceipt;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function create(array $data): Order
    {
        try {
            return DB::transaction(function () use ($data) {
                $total = 0;
                $order = Order::create([
                    'user_id' => $data['user_id'],
                    'total' => 0,
                    'state' => 'pending',
                ]);

                foreach ($data['products'] as $item) {
                    $product = Product::findOrFail($item['id']);

                    // 🔹 Verificar stock
                    if ($product->stock < $item['quantity']) {
                        throw new Exception("Stock insuficiente para el producto {$product->name}");
                    }

                    // 🔹 Descontar stock
                    $product->decrement('stock', $item['quantity']);

                    // 🔹 Calcular subtotal
                    $subtotal = $product->price * $item['quantity'];
                    $total += $subtotal;

                    // 🔹 Asociar al pedido
                    $order->products()->attach($product->id, [
                        'quantity' => $item['quantity'],
                        'subtotal' => $subtotal,
                    ]);
                }

                // 🔹 Guardar total final
                $order->update(['total' => $total]);

                Log::info("Total del pedido #{$order->id}: $total");

                GenerateOrderReceipt::dispatch($order);

                Log::info("Job GenerateOrderReceipt despachado para pedido #{$order->id}");

                return $order->load('products');
            });
        } catch (Exception $e) {
            Log::error('Error al crear pedido', [
                'usuario' => $data['user_id'] ?? null,
                'detalle' => $e->getMessage(),
                'payload' => $data
            ]);
            throw new Exception('No se pudo crear el pedido: ' . $e->getMessage());
        }
    }

    public function getOrdersByUser(int $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            throw new ModelNotFoundException("El usuario con ID {$userId} no existe.");
        }

        $orders = Order::with('products')
            ->where('user_id', $userId)
            ->get();

        $totalAcumulado = $orders->sum('total');

        return [
            'total_acumulado' => $totalAcumulado,
            'pedidos' => $orders
        ];
    }
}
