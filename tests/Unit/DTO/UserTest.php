<?php

namespace Tests\Unit\DTO;

use App\DTO\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function should_instantiate_user_dto()
    {
        $user = new User((object) [
            "username" => "johnsmith",
            "password" => "password"
        ]);
        $this->assertInstanceOf(User::class, $user);
    }

    /** @test */
    public function should_return_username()
    {
        $user = new User((object) [
            "username" => "johnsmith",
            "password" => "password"
        ]);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals("johnsmith", $user->getUsername());
    }

    /** @test */
    public function should_return_hashed_password()
    {
        $user = new User((object) [
            "username" => "johnsmith",
            "password" => "password"
        ]);
        $this->assertInstanceOf(User::class, $user);
        $this->assertTrue(Hash::check("password", $user->getPassword()));
    }

    /** @test */
    public function should_throw_exception_if_username_is_missing()
    {
        $this->expectException(Exception::class);
        new User((object) [
            "password" => "password"
        ]);
    }

    /** @test */
    public function should_throw_exception_if_password_is_missing()
    {
        $this->expectException(Exception::class);
        new User((object) [
            "username" => "janedoe",
        ]);
    }
}
