<?php

namespace APP\Repositories;

use APP\DTO\User;

interface UserRepositoryInterface
{
    public function registerUser(User $user) : void;
}
