<?php

namespace App\Services\Discounts;


class PercentOffCheapest implements DiscountStrategyInterface
{
    public function applyDiscount($order, $conditions)
    {
        $specialConditions = json_decode($conditions->getConditions());

        $category_id = $specialConditions->category_id ?? 1;
        $categoryItems = $order->orderItems->filter(fn($item) => $item->product->category_id == $category_id);

        if ($categoryItems->count() >= ($specialConditions->min_quantity ?? 1)) {
            $cheapestItem = $categoryItems->sortBy('product.price')->first();
            $discountAmount = $conditions->getType() == "percentage" ? $cheapestItem->product->price * $conditions->getValue() / 100 : $conditions->getValue();

            return [
                'discount_reason' => $conditions->getReason(),
                'discount_amount' => $discountAmount,
                'subtotal' => $order->total - $discountAmount,
            ];
        }

        return null;
    }
}