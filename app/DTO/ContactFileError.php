<?php

namespace App\DTO;

class ContactFileError
{
    private $contact_file_id;
    private $field;
    private $description;
    private $line;
    private $errorMessage;

    public function __construct(
        $contact_file_id,
        $field,
        $description,
        $line,
        $errorMessage
    ) {
        $this->contact_file_id = $contact_file_id;
        $this->field = $field;
        $this->description = $description;
        $this->line = $line;
        $this->errorMessage = $errorMessage;
    }

    public function asArray()
    {
        return [
            'contact_file_id' => $this->contact_file_id,
            'field' => $this->field,
            'description' => $this->description,
            'line' => $this->line,
            'error_message' => $this->errorMessage
        ];
    }
}