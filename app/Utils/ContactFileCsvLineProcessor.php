<?php

namespace App\Utils;

use App\Rules\CSVLineCreditCardRule;
use App\Rules\CSVLineDateOfBirthRule;
use App\Rules\CSVLineNameRule;
use App\Rules\CSVLinePhoneRule;
use Exception;
use Illuminate\Support\Facades\Validator;

class ContactFileCsvLineProcessor
{
    private $line;
    private $lineCount;
    private $data;
    private $userId;
    private $positions;

    public function __construct($line, $userId)
    {
        $this->line = $line;
        $this->lineCount = count($line);
        $this->userId = $userId;
        $this->positions = [
            'name' => 0,
            'date_of_birth' => 1,
            'phone' => 2,
            'address' => 3,
            'cc_number' => 4,
            'email' => 5
        ];
    }

    public function validate()
    {
        $this->setData();
        $validator = Validator::make(
            $this->data,
            $this->getValidationRules()
        );
        if ($validator->fails()) {
            $errors = $validator->errors();
            return (object) [
                'fails' => true,
                'errors' => $errors
            ];
        }
        return (object) ['fails' => false];
    }

    private function setData()
    {
        if ($this->lineCount < count($this->positions)) {
            throw new Exception("Line doesn't have the right amount of columns.");
        }
        $this->data = [];
        $this->setOrException('name', $this->positions['name']);
        $this->setOrException('date_of_birth', $this->positions['date_of_birth']);
        $this->setOrException('phone', $this->positions['phone']);
        $this->setOrException('address', $this->positions['address']);
        $this->setOrException('cc_number', $this->positions['cc_number']);
        $this->setOrException('email', $this->positions['email']);
    }

    private function setOrException($field, $position)
    {
        if ($position >= $this->lineCount) {
            throw new Exception("$field (position: $position) is out of bounds.");
        }
        $this->data[$field] = $this->line[$position];
    }

    public function getData()
    {
        return $this->data;
    }

    private function getValidationRules()
    {
        return [
            'name' => [
                'required',
                'max:128',
                new CSVLineNameRule()
            ],
            'date_of_birth' => [
                'required',
                new CSVLineDateOfBirthRule()
            ],
            'phone' => [
                'required',
                'max:128',
                new CSVLinePhoneRule()
            ],
            'address' => 'required',
            'cc_number' => [
                'required',
                'max:128',
                new CSVLineCreditCardRule()
            ],
            'email' => [
                'required',
                'email',
                'max:128',
                'unique:contacts,email,NULL,id,user_id,' . $this->userId
            ]
        ];
    }
}
