<?php

namespace App\Services;

use App\DTO\ContactFileError;

interface ContactFileErrorServiceInterface
{
    public function registerContactFileError(ContactFileError $contactFileError);
    public function insertBatch($insertBatch);
}