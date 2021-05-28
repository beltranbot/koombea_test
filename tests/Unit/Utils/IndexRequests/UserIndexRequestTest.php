<?php

namespace Tests\Unit\Utils\IndexRequests;

use App\Utils\IndexRequests\UserIndexRequest;
use Tests\TestCase;

class UserIndexRequestTest extends TestCase
{
    /** @test */
    public function should_instantiate_user_index_request_with_default_values()
    {
        $request = new class {
            public function has($field)
            {
                return false;
            }
        };
        $indexRequest = new UserIndexRequest($request);
        $this->assertInstanceOf(UserIndexRequest::class, $indexRequest);
        $this->assertEquals(0, $indexRequest->getPage());
        $this->assertEquals(10, $indexRequest->getPerPage());
    }

    /** @test */
    public function should_instantiate_user_index_request_with_given_values()
    {
        $request = new class {
            public $page = 3;
            public $per_page = 15;
            public function has($field)
            {
                return true;
            }
        };
        $indexRequest = new UserIndexRequest($request);
        $this->assertInstanceOf(UserIndexRequest::class, $indexRequest);
        $this->assertEquals(3, $indexRequest->getPage());
        $this->assertEquals(15, $indexRequest->getPerPage());
    }
}
