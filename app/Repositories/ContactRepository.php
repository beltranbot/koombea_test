<?php

namespace App\Repositories;

use App\DTO\Contact;
use App\Models\Contact as ContactModel;
use App\Repositories\ContactRepositoryInterface;
use App\Utils\DTOs\ContactIndexDTO;

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

    public function getPaginated(ContactIndexDTO $dto)
    {
        $contacts = ContactModel::where("user_id", $dto->getUserId())
            ->paginate($dto->getPerPage());
        return $contacts;
    }
}
