<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function create(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'since' => now(),
            'revenue' => 0.00,
        ]);
    }
}
