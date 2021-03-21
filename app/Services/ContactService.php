<?php

namespace App\Services;

use App\DTO\Contact;
use App\DTO\ContactFile;
use App\DTO\ContactFileEntry;
use App\DTO\ContactFileStatus;
use App\Jobs\ProcessContactFile;
use App\Repositories\ContactFileRepositoryInterface;
use App\Repositories\ContactRepositoryInterface;
use App\Utils\Response;
use App\Utils\ResponseCode;
use Illuminate\Support\Facades\Auth;

class ContactService implements ContactServiceInterface
{
    public function __construct(
        StorageServiceInterface $localStorageService,
        ContactFileRepositoryInterface $contactFileRepository,
        ContactRepositoryInterface $contactRepository
    ) {
        $this->localStorageService = $localStorageService;
        $this->contactFileRepository = $contactFileRepository;
        $this->contactRepository = $contactRepository;
    }

    public function registerContactFileToQueue(ContactFile $contactFile): Response
    {
        $fileLocation = $this->localStorageService->storeFile($contactFile);
        $contactFile = $this->contactFileRepository->register(new ContactFileEntry(
            Auth::id(),
            ContactFileStatus::WAITING,
            $fileLocation,
            $contactFile->getFilename()
        ));
        ProcessContactFile::dispatch($contactFile);
        return new Response(['message' => "File upload was successful"], ResponseCode::OK);
    }

    public function registerContact(Contact $contact)
    {
        $this->contactRepository->registerContact($contact);
    }
}
