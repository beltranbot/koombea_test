<?php

namespace App\Services;

use App\DTO\Contact;
use App\DTO\ContactFile;
use App\Utils\Response;

interface ContactServiceInterface
{
    public function registerContactFileToQueue(ContactFile $contactFile) : Response;
    public function registerContact(Contact $contact);
}