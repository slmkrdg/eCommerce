<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteOrderRequest extends FormRequest
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
            'id' => 'required|integer|exists:orders,id',
        ];
    }
}