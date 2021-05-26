<?php

namespace App\Utils\IndexRequests;

abstract class IndexRequestAbstract
{
    private $page = 0;
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
        $this->setPage();
    }

    private function setPage()
    {
        if ($this->request->has("page")) {
            $this->page = is_numeric($this->request->page) ? intval($this->request->page) : 0;
        }
    }

    public function getPage()
    {
        return $this->page;
    }
}
