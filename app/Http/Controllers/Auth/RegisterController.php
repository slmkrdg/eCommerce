<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;


class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterUserRequest $request)
    {

        $user = $this->userService->register($request->validated());

        return response()->json([
            'message' => 'User and customer successfully registered!',
            'user' => $user,
        ]);
    }
}
