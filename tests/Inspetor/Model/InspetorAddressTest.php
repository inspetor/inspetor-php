<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\InspetorAddress;
use Inspetor\Exception\ModelException\InspetorAddressException;
use PHPUnit\Framework\TestCase;

class InspetorAddressTest extends TestCase {

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
        $address = $this->getDefaultAddress();
        $this->assertNull($address->isValid());
    }

    public function testIfIsNotValidWhenStreetIsNull() {
        $address = $this->getDefaultAddress();
        $address->setStreet(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAddressException::class);

        $address->isValid();
    }

    public function testIfIsNotValidWhenZipCodeIsNull() {
        $address = $this->getDefaultAddress();
        $address->setZipCode(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAddressException::class);

        $address->isValid();
    }

    public function testIfIsNotValidWhenCityIsNull() {
        $address = $this->getDefaultAddress();
        $address->setCity(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAddressException::class);

        $address->isValid();
    }

    public function testIfIsNotValidWhenStateIsNull() {
        $address = $this->getDefaultAddress();
        $address->setState(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAddressException::class);

        $address->isValid();
    }

    public function testIfIsNotValidWhenCountryIsNull() {
        $address = $this->getDefaultAddress();
        $address->setCountry(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAddressException::class);

        $address->isValid();
    }

    public function testIfIsValidWhenLatitudeIsNull() {
        $address = $this->getDefaultAddress();
        $address->setLatitude(null);

        $this->assertNull($address->isValid());
    }

    public function testIfIsValidWhenLongitudeIsNull() {
        $address = $this->getDefaultAddress();
        $address->setLongitude(null);

        $this->assertNull($address->isValid());
    }

}


?>