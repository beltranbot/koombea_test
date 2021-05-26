<?php

namespace App\Services;

use App\DTO\User;
use App\Repositories\UserRepositoryInterface;
use App\Utils\IndexRequests\UserIndexRequest;
use App\Utils\Response;
use App\Utils\ResponseCode;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(User $user) : Response
    {
        $this->userRepository->registerUser($user);
        return new Response([
            "message" => "Users was created successfully",
        ], ResponseCode::OK);
    }

    public function getPaginated(UserIndexRequest $request)
    {
        return $this->userRepository->getPaginated($request);
    }
}
