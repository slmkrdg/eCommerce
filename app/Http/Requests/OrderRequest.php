<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;


class OrderRequest extends FormRequest
{
    
    public function authorize()
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'items'                 => 'required|array',
            'items.*.product_id'    => 'required|integer|exists:products,id',
            'items.*.quantity'      => 'required|integer|min:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $items = $this->input('items', []);
            foreach ($items as $item) {
                $product = Product::find($item['product_id']);

                if ($product && $product->stock < $item['quantity']) {
                    $validator->errors()->add(
                        'items.' . $item['product_id'],
                        "Ürün ID {$item['product_id']} Yeterli stoğu yok. Stok miktarı: {$product->stock}"
                    );
                }
            }
        });
    }
}
