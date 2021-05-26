<?php

namespace APP\Repositories;

use APP\DTO\User;
use App\Utils\IndexRequests\UserIndexRequest;

interface UserRepositoryInterface
{
    public function registerUser(User $user) : void;

    public function getPaginated(UserIndexRequest $request);
}
