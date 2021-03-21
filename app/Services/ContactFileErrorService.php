<?php

namespace App\Services;

use App\DTO\ContactFileError;
use App\Repositories\ContactFileErrorRepositoryInterface;

class ContactFileErrorService implements ContactFileErrorServiceInterface
{
    public function __construct(ContactFileErrorRepositoryInterface $contactFileErrorRepository)
    {
        $this->contactFileErrorRepository = $contactFileErrorRepository;
    }

    public function registerContactFileError(ContactFileError $contactFileError)
    {
        $this->contactFileErrorRepository->registerContactFileError($contactFileError);
    }

    public function insertBatch($insertBatch)
    {
        $this->contactFileErrorRepository->insertBatch($insertBatch);
    }
}