<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Illuminate\Support\Carbon;

class ExpireOldOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Marca como expirado las ordenes con más de 24 horas de antiguedad';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('🔍 Buscando ordenes pendientes con más de 24 horas...');

        // 🔹 Buscar ordenes pendientes de más de 24 horas
        $expiredOrders = Order::where('state', 'pending')
            ->where('created_at', '<', Carbon::now()->subDay())
            ->get();

        if ($expiredOrders->isEmpty()) {
            $this->info('✅ No hay ordenes pendientes para expirar.');
            return Command::SUCCESS;
        }

        // 🔹 Actualizar el estado de cada ordenes
        foreach ($expiredOrders as $order) {
            $order->update(['state' => 'expired']);
            $this->line("🕒 Orden #{$order->id} del usuario {$order->user_id} ha sido marcado como EXPIRADO.");
        }

        $this->newLine();
        $this->info('✅ Proceso completado correctamente.');
        $this->info('Total de Orden expirados: ' . $expiredOrders->count());

        return Command::SUCCESS;
    }
}
