<?php

namespace Tests\Unit\Utils\DTOs;

use App\Utils\DTOs\ContactsFilesIndexDTO;
use Tests\TestCase;

class ContactsFilesIndexDTOTest extends TestCase
{
    /** @test */
    public function should_instantiate_contacts_files_index_request()
    {
        $request = new class
        {
            public function has($field)
            {
                return false;
            }
        };
        $dto = new ContactsFilesIndexDTO(1, $request);
        $this->assertInstanceOf(ContactsFilesIndexDTO::class, $dto);
        $this->assertEquals(0, $dto->getPage());
        $this->assertEquals(1, $dto->getUserId());
        $this->assertEquals(15, $dto->getPerPage());
    }

    /** @test */
    public function should_set_page_correctly()
    {
        $request = new class
        {
            public $page = 10;
            public $per_page = 10;
            public function has($field)
            {
                return in_array($field, ["page", "per_page"]);
            }
        };
        $dto = new ContactsFilesIndexDTO(1, $request);
        $this->assertInstanceOf(ContactsFilesIndexDTO::class, $dto);
        $this->assertEquals(10, $dto->getPage());
        $this->assertEquals(1, $dto->getUserId());
        $this->assertEquals(10, $dto->getPerPage());
    }
}
