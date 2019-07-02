<?php

namespace Inspetor\Test\Model;

use Inspetor\InspetorClient;
use Inspetor\Model\Account;
use Inspetor\Model\Address;
use Inspetor\Exception\ModelException\AccountException;
use PHPUnit\Framework\TestCase;
use Rhumsaa\Uuid\Console\Exception;

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

        //$this->expectExceptionCode(7001);
        try {
            $account->isValid();
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

}


?>