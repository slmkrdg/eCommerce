<?php

namespace App\Services\Discounts;

use App\Services\Discounts\Data\DiscountData;
use App\Services\Discounts\DiscountStrategyInterface;

class DiscountFactory
{
    /**
     * İndirim sınıfını oluştur
     *
     * @param string $ruleClass
     * @param  $order
     * @param  DiscountData $conditions
     * @return object
     */
    public static function create(string $ruleClass, $order, DiscountData $conditions): DiscountStrategyInterface
    {
        $classPath = "App\Services\Discounts\\".$ruleClass;

        try {
            return new $classPath($order,$conditions);
        } catch (\Throwable $th) {
            throw new \InvalidArgumentException("Desteklenmeyen class: {$ruleClass}");
        }

    }
}