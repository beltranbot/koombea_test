<?php

namespace App\Services;

use APP\DTO\User;
use App\Utils\IndexRequests\UserIndexRequest;
use APP\Utils\Response;

interface UserServiceInterface
{
    public function registerUser(User $user) : Response;

    public function getPaginated(UserIndexRequest $request);
}
