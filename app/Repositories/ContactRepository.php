<?php

namespace App\Repositories;

use App\DTO\Contact;
use App\Models\Contact as ContactModel;
use App\Repositories\ContactRepositoryInterface;

class ContactRepository implements ContactRepositoryInterface
{
    public function __construct(Contactmodel $contactModel)
    {
        $this->contactModel = $contactModel;
    }

    public function registerContact(Contact $contact)
    {
        $this->contactModel->registerContact($contact);
    }
}