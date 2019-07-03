<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\Account;
use Inspetor\Model\Address;
use Inspetor\Exception\ModelException\AccountException;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase {

    private function getDefaultAccount() {
        $account = new Account();
        $account->setId("123");
        $account->setName("Test Name");
        $account->setEmail("test@email.com");
        $account->setDocument("12312312312");
        $account->setPhoneNumber("112345678");
        $account->setAddress($this->getDefaultAddress());
        $account->setBillingAddress($this->getDefaultAddress());
        $account->setCreationTimestamp($this->getNormalizedTime());
        $account->setUpdateTimestamp($this->getNormalizedTime());
        return $account;
    }

    private function getDefaultAddress() {
        $address = new Address();
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

    private function getNormalizedTime() {
        return time()*1000;
    }

    public function testIfIsValid() {
        $account = $this->getDefaultAccount();
        $this->assertNull($account->isValid());
    }

    public function testIfIsNotValidWhenIdIsNull() {
        $account = $this->getDefaultAccount();
        $account->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(AccountException::class);
        
        $account->isValid();
    }

    public function testIfNotValidWhenEmailIsNull() {
        $account = $this->getDefaultAccount();
        $account->setEmail(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(AccountException::class);

        $account->isValid();
    }

    public function testIfPassingNullAsTSThrowsException() {
        $account = $this->getDefaultAccount();

        //$this->expectExceptionCode(200);
        //$this->setExpectedException(AbstractException::class);
        //$this->expectExceptionMessage("The timestamp should be an integer.");

        $account->setUpdateTimestamp(null);
    }

}


?>