<?php

namespace App\Http\Controllers;

use App\DTO\User as UserDTO;
use App\Http\Requests\UserPostRequest;
use App\Models\User;
use App\Services\UserServiceInterface;
use App\Utils\IndexRequests\UserIndexRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function store(UserPostRequest $request)
    {
        $user = new UserDTO($request);
        $response = $this->userService->registerUser($user);
        return response()->json($response->getResponse(), $response->gethttpCode());
    }

    public function index(Request $request)
    {
        $indexRequest = new UserIndexRequest($request);
        $users = $this->userService->getPaginated($indexRequest);
        return response()->json($users, 200);
    }
}
