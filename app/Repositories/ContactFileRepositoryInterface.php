<?php

namespace App\Repositories;

use App\DTO\ContactFileEntry;

interface ContactFileRepositoryInterface
{
    public function register(ContactFileEntry $contactFileEntry) : Object;
}