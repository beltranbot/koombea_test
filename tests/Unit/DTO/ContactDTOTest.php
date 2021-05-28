<?php

namespace Tests\Unit\DTO\ContactDTOTest;

use App\DTO\Contact;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ContactDTOTest extends TestCase
{
    /** @test */
    public function should_instantiate_contact_dto()
    {
        $userId = 1;
        $name = "johh smith";
        $dateOfBirth = "2019-04-17";
        $phone = "(12) 345 678 91 01";
        $address = "test addres";
        $creditCardNumber = "222145678910111";
        $email = "test@example.com";
        $contact = new Contact($userId, $name, $dateOfBirth, $phone, $address, $creditCardNumber, $email);
        $this->assertInstanceOf(Contact::class, $contact);
    }

    /** @test */
    public function as_arary_should_return_valid_values()
    {
        $userId = 1;
        $name = "johh smith";
        $dateOfBirth = "2019-04-17";
        $phone = "(12) 345 678 91 01";
        $address = "test addres";
        $creditCardNumber = "222145678910111";
        $email = "test@example.com";
        $contact = new Contact($userId, $name, $dateOfBirth, $phone, $address, $creditCardNumber, $email);
        $this->assertInstanceOf(Contact::class, $contact);
        $arr = $contact->asArray();
        $this->assertEquals($userId, $arr["user_id"]);
        $this->assertEquals($name, $arr["name"]);
        $this->assertEquals($dateOfBirth, $arr["date_of_birth"]);
        $this->assertEquals($phone, $arr["phone"]);
        $this->assertEquals($address, $arr["address"]);
        $this->assertTrue(Hash::check($creditCardNumber, $arr["cc_number"]));
        $this->assertEquals("0111", $arr["cc_last_four_digits"]);
        $this->assertEquals(15, $arr["cc_length"]);
        $this->assertEquals("MasterCard", $arr["brand"]);
        $this->assertEquals("test@example.com", $arr["email"]);
    }
}
