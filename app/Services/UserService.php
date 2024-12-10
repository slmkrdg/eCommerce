<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Repositories\CustomerRepository;

class UserService
{
    protected $userRepository;
    protected $customerRepository;

    public function __construct(UserRepository $userRepository, CustomerRepository $customerRepository)
    {
        $this->userRepository = $userRepository;
        $this->customerRepository = $customerRepository;
    }

    public function register(array $data)
    {
        return DB::transaction(function () use($data){
            $customer = $this->customerRepository->create([
                'name' => $data['name'],
            ]);

            return $this->userRepository->create(array_merge($data,["customer_id" => $customer->id]));
        });
    }
}
