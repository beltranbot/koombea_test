<?php

namespace App\Repositories;

use App\DTO\User;
use App\Models\User as UserModel;

class UserRepository implements UserRepositoryInterface
{
    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function registerUser(User $user) : void
    {
        $this->userModel->registerUser($user);
    }
}
