<?php

namespace Tests\Unit\Repositories;

use App\DTO\User as UserDTO;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    /** @test */
    public function should_register_user()
    {
        $user = new UserDTO((object) [
            "username" => "johnsmith",
            "password" => "password"
        ]);
        $repository = new UserRepository();
        $repository->register($user);
        $this->assertDatabaseHas("users", [
            "username" => "johnsmith"
        ]);
        $dbUser = User::where("username", "johnsmith")->first();
        $this->assertTrue(Hash::check("password", $dbUser->password));
    }

    /** @test */
    public function should_get_users_paginated()
    {
        $this->assertTrue(false);
    }
}
