<?php
namespace Tests\Unit\Utils\DTOs;

use App\Utils\DTOs\ContactIndexDTO;
use GuzzleHttp\Psr7\Request;
use Tests\TestCase;

class ContactIndexDTOTest extends TestCase
{
    /** @test */
    public function should_instantiate_contact_index_request()
    {
        $request = new class {
            public function has($field) {
                return false;
            }
        };
        $contactIndexRequest = new ContactIndexDTO(1, $request);
        $this->assertInstanceOf(ContactIndexDTO::class, $contactIndexRequest);
        $this->assertEquals(0, $contactIndexRequest->getPage());
        $this->assertEquals(1, $contactIndexRequest->getUserId());
        $this->assertEquals(15, $contactIndexRequest->getPerPage());
    }

    /** @test */
    public function should_set_page_correctly()
    {
        $request = new class {
            public $page = 10;
            public $per_page = 10;
            public function has($field) {
                return in_array($field, ["page", "per_page"]);
            }
        };
        $contactIndexRequest = new ContactIndexDTO(1, $request);
        $this->assertInstanceOf(ContactIndexDTO::class, $contactIndexRequest);
        $this->assertEquals(10, $contactIndexRequest->getPage());
        $this->assertEquals(1, $contactIndexRequest->getUserId());
        $this->assertEquals(10, $contactIndexRequest->getPerPage());
    }
}
