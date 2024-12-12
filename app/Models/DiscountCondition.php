<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_rule_id',
        'condition_key',
        'condition_value',
    ];

    /**
     * Get the discount rule that owns the condition.
     */
    public function discountRule()
    {
        return $this->belongsTo(DiscountRule::class);
    }
}