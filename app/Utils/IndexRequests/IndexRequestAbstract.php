<?php

namespace App\Utils\IndexRequests;

abstract class IndexRequestAbstract
{
    private $page = 0;
    private $perPage = 10;
    private $request;

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
            $this->page = is_numeric($this->request->page) ? intval($this->request->page) : 0;
        }
    }

    private function setPerPage()
    {
        if ($this->request->has("per_page")) {
            $this->perPage = is_numeric($this->request->per_page) ? intval($this->request->per_page) : 10;
        }
    }
}
