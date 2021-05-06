<?php

namespace App\tests\Unit\Utils\CreditCard\validators;

use App\Utils\CreditCard\validators\CreditCardNumberValidator;
use PHPUnit\Framework\TestCase;

class CreditCardNumberValidatorTest extends TestCase
{
    /** @test */
    public function invalid_credit_card_number_should_return_false()
    {
        $number = "xxx";
        $validator = new CreditCardNumberValidator($number);
        $this->assertFalse($validator->isValid());
    }

    /** @test */
    public function valid_american_express_number_should_return_true()
    {
        $number = "341234567891011";
        $validator = new CreditCardNumberValidator($number);
        $this->assertTrue($validator->isValid());
        $this->assertEquals("American Express", $validator->getBrand());
    }

    /** @test */
    public function valid_diners_club_number_should_return_true()
    {
        $number = "36123456789101";
        $validator = new CreditCardNumberValidator($number);
        $this->assertTrue($validator->isValid());
        $this->assertEquals("Diners Club", $validator->getBrand());
    }

    /** @test */
    public function valid_discover_card_number_should_return_true()
    {
        $number = "6011345678910111";
        $validator = new CreditCardNumberValidator($number);
        $this->assertTrue($validator->isValid());
        $this->assertEquals("Discover Card", $validator->getBrand());
    }

    /** @test */
    public function valid_JCB_number_should_return_true()
    {
        $number = "3528345678910111";
        $validator = new CreditCardNumberValidator($number);
        $this->assertTrue($validator->isValid());
        $this->assertEquals("JCB", $validator->getBrand());
    }

    /** @test */
    public function valid_master_card_number_should_return_true()
    {
        $number = "222145678910111";
        $validator = new CreditCardNumberValidator($number);
        $this->assertTrue($validator->isValid());
        $this->assertEquals("MasterCard", $validator->getBrand());
    }

    /** @test */
    public function valid_visa_number_should_return_true()
    {
        $number = "4123456789101";
        $validator = new CreditCardNumberValidator($number);
        $this->assertTrue($validator->isValid());
        $this->assertEquals("Visa", $validator->getBrand());
    }
}
