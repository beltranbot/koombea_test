<?php

namespace App\tests\Unit\Utils\CreditCard\validators;

use App\Utils\CreditCard\validators\JCBValidator;
use PHPUnit\Framework\TestCase;

class JCBVAlidatorTest extends TestCase
{
    /** @test */
    public function jcb_3528_3589_card_number_should_return_jcb()
    {
        $number_tails = [
            "345678910111", // 16
            "3456789101112", // 17
            "34567891011121", // 18
            "345678910111213", // 19
        ];
        for ($i = 3528; $i <= 3589; $i++) {
            foreach ($number_tails as $number_tail) {
                $number = "$i$number_tail";
                $validator = new JCBValidator($number);
                $this->assertTrue($validator->isValid());
                $this->assertEquals("JCB", $validator->getBrand());
            }
        }
    }
}
