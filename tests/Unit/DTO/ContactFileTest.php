<?php

namespace App\DTO;

use Tests\TestCase;

class ContactFileTest extends TestCase
{
    /** @test */
    public function should_instantiate_contact_file_dto()
    {
        $request = new class
        {
            public function file($file)
            {
                return new class
                {
                    public function getClientOriginalName()
                    {
                        return "originalname.csv";
                    }

                    public function getFile()
                    {
                        return "hello world";
                    }
                };
            }
        };
        $contactFile = new ContactFile($request);
    }
}
