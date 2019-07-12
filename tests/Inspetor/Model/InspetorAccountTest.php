<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\InspetorAccount;
use Inspetor\Model\InspetorAddress;
use Inspetor\Exception\ModelException\InspetorAccountException;
use PHPUnit\Framework\TestCase;

class InspetorAccountTest extends TestCase {

    private function getDefaultAccount() {
        $account = new InspetorAccount();
        $account->setId("123");
        $account->setName("Test Name");
        $account->setEmail("test@email.com");
        $account->setDocument("12312312312");
        $account->setPhoneNumber("112345678");
        $account->setAddress($this->getDefaultAddress());
        $account->setTimestamp(time());
        return $account;
    }

    private function getDefaultAddress() {
        $address = new InspetorAddress();
        $address->setStreet("Test Street");
        $address->setNumber("123");
        $address->setZipCode("123456");
        $address->setCity("Test City");
        $address->setState("Test State");
        $address->setCountry("Test Country");
        $address->setLatitude("123");
        $address->setLongitude("123");
        return $address;
    }

    public function testIfIsValid() {
        $account = $this->getDefaultAccount();
        $this->assertNull($account->isValid());
    }

    public function testIfIsNotValidWhenIdIsNull() {
        $account = $this->getDefaultAccount();
        $account->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAccountException::class);

        $account->isValid();
    }

    public function testIfNotValidWhenEmailIsNull() {
        $account = $this->getDefaultAccount();
        $account->setEmail(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAccountException::class);

        $account->isValid();
    }

    public function testIfPassingNullAsTSThrowsException() {
        $account = $this->getDefaultAccount();

        //$this->expectExceptionCode(200);
        //$this->setExpectedException(GeneralException::class);
        //$this->expectExceptionMessage("The timestamp should be an integer.");

        $account->setTimestamp(null);
    }

}


?>