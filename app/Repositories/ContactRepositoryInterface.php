<?php

namespace App\Repositories;

use App\DTO\Contact;

interface ContactRepositoryInterface
{
    public function registerContact(Contact $contact);
}