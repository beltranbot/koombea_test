<?php

namespace App\tests\Unit\Rules;

use App\Rules\CSVLineNameRule;
use PHPUnit\Framework\TestCase;

class CSVLineNameRuleTest extends TestCase
{
    /** @test */
    public function invalid_name_should_return_false()
    {
        $rule = new CSVLineNameRule();
        $name = " hello world0";
        $this->assertFalse($rule->passes("name", $name));
    }

    /** @test */
    public function valid_name_should_return_true()
    {
        $rule = new CSVLineNameRule();
        $name = "John-Smith";
        $this->assertTrue($rule->passes("name", $name));
    }
}
