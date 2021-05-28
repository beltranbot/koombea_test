<?php

namespace App\Services;

use App\Repositories\ContactFileRepository;
use App\Utils\DTOs\ContactsFilesIndexDTO;

class ContactFileService
{
    public function __construct(ContactFileRepository $contactFileRepository)
    {
        $this->contactFileRepository = $contactFileRepository;
    }

    public function getPaginated(ContactsFilesIndexDTO $dto)
    {
        return $this->contactFileRepository->getPaginated($dto);
    }
}
