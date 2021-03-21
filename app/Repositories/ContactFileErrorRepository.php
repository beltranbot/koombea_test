<?php

namespace App\Repositories;

use App\DTO\ContactFileError;
use App\Models\ContactFileError as ContactFileErrorModel;

class ContactFileErrorRepository implements ContactFileErrorRepositoryInterface
{
    public function __construct(ContactFileErrorModel $contactFileErrorModel)
    {
        $this->contactFileErrorModel = $contactFileErrorModel;
    }

    public function registerContactFileError(ContactFileError $contactFileError)
    {
        $this->contactFileErrorModel->registerContactFileError($contactFileError);
    }

    public function insertBatch($insertBatch)
    {
        $this->contactFileErrorModel->insertBatch($insertBatch);
    }
}
