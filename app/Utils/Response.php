<?php

namespace App\Utils;

class Response
{
    private $response;
    private $httpCode;

    public function __construct(Array $response, int $httpCode)
    {
        $this->response = $response;
        $this->httpCode = $httpCode;
    }

    public function getResponse() : Array
    {
        return $this->response;
    }

    public function getHttpCode() : int
    {
        return $this->httpCode;
    }
}
