<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateDiscountRequest extends FormRequest
{
    function validationData() { 
        return $this->route()->parameters(); 
    }
    
    public function authorize()
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required|integer|exists:orders,id',
        ];
    }
}