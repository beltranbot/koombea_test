<?php

namespace App\tests\Unit\Utils\CreditCard\validators;

use App\Utils\CreditCard\validators\VisaValidator;
use PHPUnit\Framework\TestCase;

class VisaValidatorTest extends TestCase
{
    /** @test */
    public function visa_4_13_and_16_card_number_should_return_visa()
    {
        $numbers = [
            "4123456789101",
            "4123456789101112",
        ];
        foreach ($numbers as $number) {
            $validator = new VisaValidator($number);
            $this->assertTrue($validator->isValid());
            $this->assertEquals("Visa", $validator->getBrand());
        }
    }
}
