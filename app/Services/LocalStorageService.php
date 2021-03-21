<?php

namespace App\Services;

use App\DTO\ContactFile;
use Exception;
use Illuminate\Support\Facades\Storage;

class LocalStorageService extends StorageServiceAbstract implements StorageServiceInterface
{
    public function __construct($disk, $path)
    {
        parent::__construct($disk);
        $this->setPath($path);
    }

    public function storeFile(ContactFile $contactFile)
    {
        $this->isPathSet();
        return Storage::disk($this->disk)->put($this->path, $contactFile->getFile());
    }

    private function isPathSet()
    {
        if (is_null($this->path)) {
            new Exception("Path must be set for local storage.");
        }
    }
}