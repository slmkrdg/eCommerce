<?php

namespace App\Services\Discounts;

interface DiscountStrategyInterface
{
    public function applyDiscount($order, $conditions);
}