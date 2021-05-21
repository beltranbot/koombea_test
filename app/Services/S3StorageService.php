<?php

namespace App\Services;

use App\DTO\ContactFile;
use Illuminate\Support\Facades\Storage;

class S3StorageService extends StorageServiceAbstract implements StorageServiceInterface
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
}
