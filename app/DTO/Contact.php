<?php

namespace App\DTO;

use App\Utils\CreditCardFactory;

class Contact
{
    private $userId;
    private $name;
    private $dateOfBirth;
    private $phone;
    private $address;
    private $creditCardNumber;
    private $ccLength;
    private $ccLastFourDigits;
    private $brand;
    private $email;

    public function __construct(
        $userId,
        $name,
        $dateOfBirth,
        $phone,
        $address,
        $creditCardNumber,
        $email
    ) {
        $this->userId = $userId;
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->phone = $phone;
        $this->address = $address;
        $this->creditCardNumber = bcrypt($creditCardNumber);
        $this->ccLength = strlen($creditCardNumber);
        $this->ccLastFourDigits = substr($creditCardNumber, -4);
        $this->brand = CreditCardFactory::getBrand($creditCardNumber);
        $this->email = $email;
    }

    public function asArray()
    {
        return [
            'user_id' => $this->userId,
            'name' => $this->name,
            'date_of_birth' => $this->dateOfBirth,
            'phone' => $this->phone,
            'address' => $this->address,
            'cc_number' => $this->creditCardNumber,
            'cc_length' => $this->ccLength,
            'cc_last_four_digits' => $this->ccLastFourDigits,
            'brand' => $this->brand,
            'email' => $this->email
        ];
    }
}
