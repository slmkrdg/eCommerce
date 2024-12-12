<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;

class OrderRepository
{
    public function create(array $data, int $customerId)
    {
        $order = Order::create(['customer_id' => $customerId, 'total' => 0]);

        $dataToInsert = [];

        foreach ($data['items'] as $item) {

            $product = Product::find($item['product_id'])->decrement('stock', $item['quantity']);

            $dataToInsert[] = [
                'order_id'      => $order->id,
                'product_id'    => $item['product_id'],
                'quantity'      => $item['quantity'],
                'unit_price'    => $product?->price ?? 1,
                'total'         => $item['quantity'] * ($product?->price ?? 1),
                'created_at'    => now() 
            ];
        }
        
        OrderItem::insert($dataToInsert);
        
        return $order->load('orderItems');
    }

    public function list(int $customerId)
    {
        return Order::with('orderItems')->where("customer_id",$customerId)->get();
    }

    public function delete(int $id,int $customerId)
    {
        $order = Order::where('id', $id)->where('customer_id', $customerId)->firstOrFail();;
        $order->orderItems()->delete();
        $order->delete();
    }
}