<?php

namespace App\DTO;

class ContactFile
{
    private $file;

    public function __construct($request)
    {
        $this->file = $request->file('file');
    }

    public function getFilename()
    {
        return $this->file->getClientOriginalName();
    }

    public function getFile()
    {
        return $this->file;
    }
}