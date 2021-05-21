<?php

namespace App\Services;

use Exception;

abstract class StorageServiceAbstract implements StorageServiceInterface
{
    protected $disk;
    protected $path = null;

    public function __construct($disk)
    {
        $this->disk = $disk;
    }

    protected function setPath($path)
    {
        $this->path = $path;
    }

    protected function isPathSet()
    {
        if (is_null($this->path)) {
            new Exception("Path must be set for the storage.");
        }
    }
}
