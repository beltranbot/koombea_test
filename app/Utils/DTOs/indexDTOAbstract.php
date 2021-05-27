<?php

namespace App\Utils\DTOs;

abstract class IndexDTOAbstract
{
    private $page = 0;
    private $perPage = 15;

    public function __construct($request)
    {
        $this->request = $request;
        $this->setPage();
        $this->setPerPage();
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    private function setPage()
    {
        if ($this->request->has("page")) {
            $this->page = $this->request->page;
        }
    }

    private function setPerPage()
    {
        if ($this->request->has("per_page")) {
            $this->perPage = $this->request->per_page;
        }
    }
}
