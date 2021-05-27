<?php

namespace App\Utils\DTOs;

abstract class UserRoleIndexDTOAbstract extends IndexDTOAbstract
{
    private $userId;

    public function __construct($userId, $request)
    {
        parent::__construct($request);
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}
