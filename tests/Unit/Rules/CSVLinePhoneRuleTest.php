<?php

namespace App\test\Unit\Rules;

use App\Rules\CSVLinePhoneRule;
use PHPUnit\Framework\TestCase;

class CSVLinePhoneRuleTest extends TestCase
{
    /** @test */
    public function invalid_phone_number_should_return_false()
    {
        $number = "(57) 123 456 78 90";
        $rule = new CSVLinePhoneRule();
        $this->assertFalse($rule->passes("phone", $number));
    }

    /** @test */
    public function valid_phone_number_with_dashes_should_return_false()
    {
        $number = "(+57) 123-456-78-90";
        $rule = new CSVLinePhoneRule();
        $this->assertTrue($rule->passes("phone", $number));
    }

    /** @test */
    public function valid_phone_number_with_spaces_should_return_false()
    {
        $number = "(+57) 123 456 78 90";
        $rule = new CSVLinePhoneRule();
        $this->assertTrue($rule->passes("phone", $number));
    }
}
