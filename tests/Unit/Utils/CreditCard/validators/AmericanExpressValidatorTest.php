<?php

namespace App\tests\Unit\Utils\CreditCard\validators;

use App\Utils\CreditCard\validators\AmericanExpressValidator;
use Tests\TestCase;

class AmericanExpressValidatorTest extends TestCase
{
    /** @test */
    public function invalid_card_number_should_return_false()
    {
        $number = "abc123";
        $validator = new AmericanExpressValidator($number);
        $this->assertFalse($validator->isValid());
    }

    /** @test */
    public function american_express_34_15_card_number_should_return_american_express()
    {
        $number = "341234567891011";
        $validator = new AmericanExpressValidator($number);
        $this->assertTrue($validator->isValid());
        $this->assertEquals("American Express", $validator->getBrand());
    }

    /** @test */
    public function american_express_37_15_card_number_should_return_american_express()
    {
        $number = "371234567891011";
        $validator = new AmericanExpressValidator($number);
        $this->assertTrue($validator->isValid());
        $this->assertEquals("American Express", $validator->getBrand());
    }
}