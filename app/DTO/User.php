<?php

namespace App\DTO;

class User
{
    private $username;
    private $password;

    public function __construct($request)
    {
        $this->username = $request->username;
        $this->password = bcrypt($request->password);
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function asArray()
    {
        return [
            'username' => $this->username,
            'password' => $this->password
        ];
    }
}
