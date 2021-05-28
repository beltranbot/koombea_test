<?php

namespace Tests\Unit\Repositories;

use App\DTO\User as UserDTO;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Utils\IndexRequests\UserIndexRequest;
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
        User::factory()->count(15)->create();
        $repository = new UserRepository();
        $request = new UserIndexRequest(new class {
            public function has($field) { return false; }
        });
        $users = $repository->getPaginated($request);
        $this->assertEquals(15, $users->total());
        $this->assertEquals(10, $users->perPage());
        $this->assertEquals(2, $users->lastPage());
        $this->assertEquals(2, $users->lastPage());
        $this->assertEquals(1, $users->currentPage());
    }
}
