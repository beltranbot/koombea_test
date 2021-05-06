<?php

namespace App\tests\Unit\Rules;

use App\Rules\CSVLineDateOfBirthRule;
use PHPUnit\Framework\TestCase;

class CSVLineDateOfBirthRuleTest extends TestCase
{
    /** @test */
    public function invalid_date_should_return_false()
    {
        $rule = new CSVLineDateOfBirthRule();
        $date = "2021-02-30";
        $this->assertFalse($rule->passes("dob", $date));
    }

    /** @test */
    public function valid_date_with_dashes_should_return_true()
    {
        $rule = new CSVLineDateOfBirthRule();
        $date = "2021-02-26";
        $this->assertTrue($rule->passes("dob", $date));
    }

    /** @test */
    public function valid_date_without_dashes_should_return_true()
    {
        $rule = new CSVLineDateOfBirthRule();
        $date = "2021-02-26";
        $this->assertTrue($rule->passes("dob", $date));
    }
}
