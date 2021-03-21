<?php

namespace App\Repositories;

use App\DTO\ContactFileEntry;
use App\Models\ContactFile;

class ContactFileRepository implements ContactFileRepositoryInterface
{
    public function __construct(ContactFile $contactFileModel)
    {
        $this->contactFileModel = $contactFileModel;
    }

    public function register(ContactFileEntry $contactFileEntry) : Object
    {
        return $this->contactFileModel->register($contactFileEntry);
    }
}