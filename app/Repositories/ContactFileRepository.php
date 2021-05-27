<?php

namespace App\Repositories;

use App\DTO\ContactFileEntry;
use App\Models\ContactFile;
use App\Utils\DTOs\ContactsFilesIndexDTO;

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

    public function getPaginated(ContactsFilesIndexDTO $dto)
    {
        $contactFiles = ContactFile::where("user_id", $dto->getUserId())
            ->paginate($dto->getPerPage());
        return $contactFiles;
    }
}
