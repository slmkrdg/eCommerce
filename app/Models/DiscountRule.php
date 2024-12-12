<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'rule_name',
        'rule_type',
        'value',
    ];

    /**
     * Get the conditions associated with the discount rule.
     */
    public function conditions()
    {
        return $this->hasMany(DiscountCondition::class);
    }
}