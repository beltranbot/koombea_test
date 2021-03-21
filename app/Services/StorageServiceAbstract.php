<?php

namespace App\Services;

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
}
