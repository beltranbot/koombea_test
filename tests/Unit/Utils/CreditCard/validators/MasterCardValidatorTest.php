<?php

namespace App\tests\Unit\Utils\CreditCard\validators;

use App\Utils\CreditCard\validators\MasterCardValidator;
use PHPUnit\Framework\TestCase;

class MasterCardValidatorTest extends TestCase
{
    /** @test */
    public function master_card_2221_2720_15_card_number_should_return_master_card()
    {
        $number_tail = "45678910111"; // 15
        for ($i = 2221; $i <= 2720; $i ++) { 
            $number = "$i$number_tail";
            $validator = new MasterCardValidator($number);
            $this->assertTrue($validator->isValid());
            $this->assertEquals("MasterCard", $validator->getBrand());
        }
    }

    /** @test */
    public function master_card_51_to_55_15_card_number_should_return_master_card()
    {
        $number_tail = "2345678910111"; // 15
        for ($i = 51; $i <= 55; $i ++) { 
            $number = "$i$number_tail";
            $validator = new MasterCardValidator($number);
            $this->assertTrue($validator->isValid());
            $this->assertEquals("MasterCard", $validator->getBrand());
        }
    }
}