<?php

namespace App\Services;

use App\DTO\ContactFile;

interface StorageServiceInterface
{
    public function storeFile(ContactFile $contactFile);
}