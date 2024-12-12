<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListOrderRequest extends FormRequest
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
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
            'sort_by' => 'nullable|string|in:created_at,customer_name',
            'sort_order' => 'nullable|string|in:asc,desc',
        ];
    }
}