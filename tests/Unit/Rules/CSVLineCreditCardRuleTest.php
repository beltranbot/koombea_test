<?php

namespace App\test\Unit\Rules;

use App\Rules\CSVLineCreditCardRule;
use PHPUnit\Framework\TestCase;

class CSVLineCreditCardRuleTest extends TestCase
{
    /** @test */
    public function valid_credit_card_number_returns_true()
    {
        $number = "222145678910111";
        $rule = new CSVLineCreditCardRule();
        $this->assertTrue($rule->passes("", $number));
    }

    /** @test */
    public function invalid_credit_card_number_returns_false()
    {
        $number = "xx145678910111";
        $rule = new CSVLineCreditCardRule();
        $this->assertFalse($rule->passes("", $number));
    }
}