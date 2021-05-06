<?php

namespace App\tests\Unit\Utils\CreditCard\validators;

use App\Utils\CreditCard\validators\DiscoveryCardValidator;
use PHPUnit\Framework\TestCase;

class DiscoveryCardValidatorTest extends TestCase
{
    /** @test */
    public function discovery_card_6011_16_to_19_card_number_should_return_discovery_card()
    {
        $numbers = [
            "6011345678910111", // 16
            "60113456789101112", // 17
            "601134567891011121", // 18
            "6011345678910111213", // 19
        ];
        foreach ($numbers as $number) {
            $validator = new DiscoveryCardValidator($number);
            $this->assertTrue($validator->isValid());
            $this->assertEquals("Discover Card", $validator->getBrand());
        }
    }

    /** @test */
    public function discovery_card_622126_to_622925_16_to_19_card_number_should_return_discovery_card()
    {
        $number_tails = [
            "5678910111", // 16
            "56789101112", // 17
            "567891011121", // 18
            "5678910111213", // 19
        ];
        for ($i = 622126; $i <= 622925; $i++) {
            foreach ($number_tails as $number_tail) {
                $number = "$i" . $number_tail;
                $validator = new DiscoveryCardValidator($number);
                $this->assertTrue($validator->isValid());
                $this->assertEquals("Discover Card", $validator->getBrand());
            }
        }
    }

    /** @test */
    public function discovery_card_644_to_649_16_to_19_card_number_should_return_discovery_card()
    {
        $number_heads = [
            "644", "645", "646", "647", "648", "649"
        ];
        $number_tails = [
            "2345678910111", // 16
            "23456789101112", // 17
            "234567891011121", // 18
            "2345678910111213", // 19
        ];
        foreach ($number_heads as $number_head) {
            foreach ($number_tails as $number_tail) {
                $number = $number_head . $number_tail;
                $validator = new DiscoveryCardValidator($number);
                $this->assertTrue($validator->isValid());
                $this->assertEquals("Discover Card", $validator->getBrand());
            }
        }
    }

    /** @test */
    public function discovery_card_65_16_to_19_card_number_should_return_discovery_card()
    {
        $number_tails = [
            "12345678910111", // 16
            "123456789101112", // 17
            "1234567891011121", // 18
            "12345678910111213", // 19
        ];
        foreach ($number_tails as $number_tail) {
            $number = "65$number_tail";
            $validator = new DiscoveryCardValidator($number);
            $this->assertTrue($validator->isValid());
            $this->assertEquals("Discover Card", $validator->getBrand());
        }
    }
}
