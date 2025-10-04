<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Requests\OrderCreateRequest;

use Illuminate\Http\JsonResponse;
use Exception;

class OrderController extends Controller
{

    protected OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\OrderCreateRequest  $request
     * @return \Illuminate\Http\Controllers\JsonResponse
     */
    public function store(OrderCreateRequest $request): JsonResponse
    {
        try {
            $order = $this->service->create($request->validated());

            return response()->json([
                'error' => false,
                'message' => 'Pedido creado correctamente',
                'data' => $order,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getOrdersByUser(int $userId): JsonResponse
    {
        try {
            $result = $this->service->getOrdersByUser($userId);

            return response()->json([
                'error' => false,
                'message' => 'Pedidos del usuario con total acumulado',
                'data' => $result
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
