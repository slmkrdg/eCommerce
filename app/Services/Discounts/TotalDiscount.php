<?php

namespace App\Services\Discounts;

class TotalDiscount implements DiscountStrategyInterface
{
    public function applyDiscount($order, $conditions)
    {

        $specialConditions = json_decode($conditions->getConditions());

        if (!isset($specialConditions->min_price) || ( isset($specialConditions->min_price) && $order->total >= $specialConditions->min_price)) {
            $discountAmount = $conditions->getType() == "percentage" ? $order->total * $conditions->getValue() / 100 : $conditions->getValue();

            return [
                'discount_reason' => $conditions->getReason(),
                'discount_amount' => $discountAmount,
                'subtotal' => $order->total - $discountAmount,
            ];
        }

        return null;
    }
}