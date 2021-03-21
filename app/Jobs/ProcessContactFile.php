<?php

namespace App\Jobs;

use App\DTO\Contact;
use App\DTO\ContactFileError;
use App\Models\ContactFile;
use App\Services\ContactFileErrorServiceInterface;
use App\Services\ContactServiceInterface;
use App\Utils\ContactFileCsvLineProcessor;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessContactFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $contactFile;
    public $timeout = 3600;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        ContactFile $contactFile
    ) {
        $this->contactFile = $contactFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        ContactServiceInterface $contactService,
        ContactFileErrorServiceInterface $contactFileErrorService
    ) {
        $this->contactService = $contactService;
        $this->contactFileErrorService = $contactFileErrorService;
        $fileLocation = Storage::path($this->contactFile->location);
        $this->line = 0;
        try {
            $handle = fopen($fileLocation, "r");
            while ($csvLine = fgetcsv($handle, 1000, ",")) {
                $this->line++;
                $this->processLine($csvLine);
            }
        } catch (Exception $e) {
            $this->contactFileErrorService->registerContactFileError(
                new ContactFileError(
                    $this->contactFile->id,
                    "file",
                    "Problems reading csv file.",
                    $this->line,
                    $e->getMessage()
                )
            );
        }
    }

    private function processLine($line)
    {
        $csvProcessor = new ContactFileCsvLineProcessor($line, $this->contactFile->user_id);
        $validation = $csvProcessor->validate();
        if (!$validation->fails) {
            $this->handleValidLine($csvProcessor);
        } else {
            $this->handleInvalidLine($csvProcessor, $validation);
        }
    }

    private function handleValidLine($csvProcessor)
    {
        $contact = (object) $csvProcessor->getData();
        $this->contactService->registerContact(new Contact(
            $this->contactFile->user_id,
            $contact->name,
            $contact->date_of_birth,
            $contact->phone,
            $contact->address,
            $contact->cc_number,
            $contact->email
        ));
    }

    private function handleInvalidLine($csvProcessor, $validation)
    {
        $insertBatch = $this->parseInsertBatchData($validation);
        $this->contactFileErrorService->insertBatch($insertBatch);
    }

    private function parseInsertBatchData($validation)
    {
        $insertBatch = [];
        foreach ($validation->errors->getMessages() as $key => $errors) {
            foreach ($errors as $error) {
                $contactFileError = new ContactFileError(
                    $this->contactFile->id,
                    $key,
                    $error,
                    $this->line,
                    null
                );
                $insertBatch[] = $contactFileError->asArray();
            }
        }
        return $insertBatch;
    }
}
