<?php

namespace App\tests\Unit\Utils\CreditCard\validators;

use App\Utils\CreditCard\validators\DinersClubValidator;
use PHPUnit\Framework\TestCase;

class DinersClubValidatorsTest extends TestCase
{
    /** @test */
    public function diners_club_36_14_to_19_card_number_should_return_diners_club()
    {
        $numbers = [
            "36123456789101", // 14
            "361234567891011", // 15
            "3612345678910111", // 16
            "36123456789101112", // 17
            "361234567891011121", // 18
            "3612345678910111213", // 19
        ];
        foreach ($numbers as $number) {
            $validator = new DinersClubValidator($number);
            $this->assertTrue($validator->isValid());
            $this->assertEquals("Diners Club",$validator->getBrand());
        }
    }

    /** @test */
    public function diners_club_54_16_card_number_should_return_diners_club()
    {
        $number = "5412345678910111";
        $validator = new DinersClubValidator($number);
        $this->assertTrue($validator->isValid());
        $this->assertEquals("Diners Club",$validator->getBrand());
    }
}