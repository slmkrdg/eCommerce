<?php

namespace App\Services;


use App\Repositories\OrderRepository;
use App\Repositories\DiscountRepository;
use App\Services\Discounts\DiscountFactory;
use App\Services\Discounts\Data\DiscountData;


class DiscountService
{
    protected $orderRepository;
    protected $discountRepository;

    public function __construct(OrderRepository $orderRepository,DiscountRepository $discountRepository)
    {
        $this->orderRepository    = $orderRepository;
        $this->discountRepository = $discountRepository;
    }
    public function calculateDiscounts(int $orderId, int $customerId)
    {
        $order = $this->orderRepository->getOrder($orderId, $customerId);
        $rules = $this->discountRepository->getAllDiscountRules();
        $discounts = [];

        foreach ($rules as $rule) {

            $strategyClass = $rule->rule_class;

            $conditions = new DiscountData();
            $conditions->setName($rule->rule_name)
                ->setType($rule->rule_type)
                ->setValue($rule->value)
                ->setConditions($rule->conditions)
                ->setReason($rule->discount_reason)
                ->setRuleClass($strategyClass);

            $strategy = (new DiscountFactory())->create($strategyClass,$order,$conditions);
            $discount = $strategy->applyDiscount($order, $conditions);

            if ($discount) {
                $discounts[] = $discount;
            }
        }

        return $discounts;
    }
}