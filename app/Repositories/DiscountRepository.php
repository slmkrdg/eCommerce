<?php

namespace App\Repositories;


use App\Models\DiscountRule;

class DiscountRepository
{

    public function getAllDiscountRules()
    {
        return DiscountRule::with('conditions')->get();
    }
}