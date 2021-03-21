<?php

namespace App\Repositories;

use App\DTO\ContactFileError;

interface ContactFileErrorRepositoryInterface
{
    public function registerContactFileError(ContactFileError $contactFileError);
    public function insertBatch($insertBatch);
}