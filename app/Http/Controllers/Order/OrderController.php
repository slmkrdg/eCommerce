<?php

namespace App\Http\Controllers\Order;


use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ListOrderRequest;
use App\Http\Requests\DeleteOrderRequest;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(OrderRequest $request): JsonResponse
    {
        $data = $this->orderService->create($request->validated(), Auth::user()->customer_id);
        return response()->json([
            'status'  => '1',  
            'message' => 'Şipariş oluşturuldu.',
            'data'    => $data
            ]);
    }

    public function list(ListOrderRequest $request): JsonResponse
    {
        $orders = $this->orderService->list(Auth::user()->customer_id);
        return response()->json([
            'status'  => '1',  
            'message' => 'Şiparişler Listelendi.',
            'data' => $orders
        ]);
    }

    public function delete(DeleteOrderRequest $request): JsonResponse
    {
        $this->orderService->delete($request->id, Auth::user()->customer_id);
        return response()->json([
            'status'  => '1', 
            'message' => 'Sipariş silindi.',
            'data'    => ['order_id' => $request->id]
        ]);
    }
}