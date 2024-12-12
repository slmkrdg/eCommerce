<?php

namespace App\Services\Discounts;

use App\Models\Order;

class BuyXGetYFree implements DiscountStrategyInterface
{
    public function applyDiscount($order, $conditions)
    {
        $discounts = [];
        $specialConditions = json_decode($conditions->getConditions());

        $category_id = $specialConditions->category_id ?? 2;

        $categoryItems = $order->orderItems->filter(fn($item) => $item->product->category_id == $category_id);

        if ($categoryItems->count() >= ($specialConditions->min_quantity ?? 2)) {

            $freeItemValue = $categoryItems->first()->product->price;
            $discounts[] = [
                'discount_reason' => $conditions->getReason(),
                'discount_amount' => $freeItemValue,
                'subtotal' => $order->total - $freeItemValue,
            ];
        }

        return $discounts;
    }
}