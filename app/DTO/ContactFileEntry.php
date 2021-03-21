<?php

namespace App\DTO;

class ContactFileEntry
{
    private $user_id;
    private $contact_file_status_id;
    private $location;

    public function __construct($user_id, $contact_file_status_id, $location, $filename)
    {
        $this->user_id = $user_id;
        $this->contact_file_status_id = $contact_file_status_id;
        $this->location = $location;
        $this->filename = $filename;
    }

    public function asArray()
    {
        return [
            "user_id" => $this->user_id,
            "contact_file_status_id" => $this->contact_file_status_id,
            "location" => $this->location,
            "filename" => $this->filename
        ];
    }
}