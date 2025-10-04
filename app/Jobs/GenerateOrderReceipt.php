<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GenerateOrderReceipt implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = "===== RECIBO DE PEDIDO #{$this->order->id} =====\n";
        $content .= "Usuario ID: {$this->order->user_id}\n";
        $content .= "Total: {$this->order->total}\n";
        $content .= "Estado: {$this->order->state}\n";
        $content .= "Fecha: {$this->order->created_at}\n";
        $content .= "=============================================\n";

        Storage::append("receipts/order_{$this->order->id}.txt", $content);

        Log::info("📧 Enviando correo al usuario {$this->order->user_id} por el pedido #{$this->order->id}");
    }
}
