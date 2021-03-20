<?php

namespace App\Http\Controllers;

use App\DTO\User;
use App\Http\Requests\UserPostRequest;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }


    public function store(UserPostRequest $request)
    {
        $user = new User($request);
        $response = $this->userService->registerUser($user);
        return response()->json($response->getResponse(), $response->gethttpCode());
    }
}
