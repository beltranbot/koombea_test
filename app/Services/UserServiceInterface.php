<?php

namespace App\Services;

use APP\DTO\User;
use APP\Utils\Response;

interface UserServiceInterface
{
    public function registerUser(User $user) : Response;
}
