<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(array $data, int $customerId)
    {
        return DB::transaction(function () use ($data, $customerId) {
            return $this->orderRepository->create($data, $customerId);
        });
    }

    public function list(int $customerId)
    {
        return $this->orderRepository->list($customerId);
    }

    public function delete(int $id, int $customerId)
    {
        $this->orderRepository->delete($id,$customerId);
    }
}
