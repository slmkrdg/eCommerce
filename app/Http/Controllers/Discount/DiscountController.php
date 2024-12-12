<?php

namespace App\Http\Controllers\Discount;


use App\Services\DiscountService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CalculateDiscountRequest;


class DiscountController extends Controller
{
    protected $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    public function calculate(CalculateDiscountRequest $request)
    {
        $validated = $request->validated();
        $discounts = $this->discountService->calculateDiscounts($validated['order_id'],Auth::user()->customer_id);
        return response()->json([
            "status"    => "1",
            "message"   => "İndirimler hesaplandı",
            "data"      => $discounts
        ]);
    }
}