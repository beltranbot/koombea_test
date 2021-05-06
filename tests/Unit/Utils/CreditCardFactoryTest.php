<?php

namespace App\tests\Unit\Utils;

use App\Utils\CreditCardFactory;
use PHPUnit\Framework\TestCase as TestCase;

class CreditCardFactoryTest extends TestCase
{
    /** @test */
    public function invalid_card_number_should_return_false()
    {
        $number = "abc123";
        $brand = CreditCardFactory::getBrand($number);
        $this->assertFalse($brand);
    }

    /** @test */
    public function american_express_34_15_card_number_should_return_american_express()
    {
        $number = "341234567891011";
        $brand = CreditCardFactory::getBrand($number);
        $this->assertEquals($brand, "American Express");
    }

    /** @test */
    public function american_express_37_15_card_number_should_return_american_express()
    {
        $number = "371234567891011";
        $this->assertEquals(
            CreditCardFactory::getBrand($number),
            "American Express"
        );
    }

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
            $this->assertEquals(
                CreditCardFactory::getBrand($number),
                "Diners Club"
            );
        }
    }

    /** @test */
    public function diners_club_54_16_card_number_should_return_diners_club()
    {
        $number = "5412345678910111";
        $this->assertEquals(
            CreditCardFactory::getBrand($number),
            "Diners Club"
        );
    }

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
            $this->assertEquals(
                CreditCardFactory::getBrand($number),
                "Discover Card"
            );
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
                $this->assertEquals(
                    CreditCardFactory::getBrand($number),
                    "Discover Card"
                );
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
                $this->assertEquals(
                    CreditCardFactory::getBrand($number),
                    "Discover Card"
                );
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
            $this->assertEquals(
                CreditCardFactory::getBrand($number),
                "Discover Card"
            );
        }
    }

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
                $this->assertEquals(
                    CreditCardFactory::getBrand($number),
                    "JCB"
                );
            }
        }
    }

    /** @test */
    public function master_card_2221_2720_15_card_number_should_return_master_card()
    {
        $number_tail = "45678910111"; // 15
        for ($i = 2221; $i <= 2720; $i++) {
            $number = "$i$number_tail";
            $this->assertEquals(
                CreditCardFactory::getBrand($number),
                "MasterCard"
            );
        }
    }

    /** @test */
    public function master_card_51_to_55_15_card_number_should_return_master_card()
    {
        $number_tail = "2345678910111"; // 15
        for ($i = 51; $i <= 55; $i++) {
            $number = "$i$number_tail";
            $this->assertEquals(
                CreditCardFactory::getBrand($number),
                "MasterCard"
            );
        }
    }

    /** @test */
    public function visa_4_13_and_16_card_number_should_return_visa()
    {
        $numbers = [
            "4123456789101",
            "4123456789101112",
        ];
        foreach ($numbers as $number) {
            $this->assertEquals(
                CreditCardFactory::getBrand($number),
                "Visa"
            );
        }
    }
}
