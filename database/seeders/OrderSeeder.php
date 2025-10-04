<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Crear 20 pedidos
        Order::factory(20)->create()->each(function ($order) {
            // Selecciona productos aleatorios para este pedido
            $products = Product::inRandomOrder()->take(rand(2, 20))->get();

            $total = 0;

            foreach ($products as $product) {
                $quantity = rand(1, 3);
                $subtotal = $quantity * $product->price;

                // Insertar en la tabla pivote con attach
                $order->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            // Actualizar total del pedido
            $order->update(['total' => $total]);
        });
    }
}