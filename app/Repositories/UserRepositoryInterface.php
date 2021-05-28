<?php

namespace APP\Repositories;

use APP\DTO\User;
use App\Models\User as ModelsUser;
use App\Utils\IndexRequests\UserIndexRequest;

interface UserRepositoryInterface
{
    public function register(User $user) : ModelsUser;

    public function getPaginated(UserIndexRequest $request);
}
