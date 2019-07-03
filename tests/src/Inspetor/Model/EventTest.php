<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\Event;
use Inspetor\Model\Category;
use Inspetor\Model\Address;
use Inspetor\Exception\ModelException\EventException;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase {

    private function getDefaultEvent() {
        $event = new Event();
        $event->setId("123");
        $event->setName("Name Test");
        $event->setDescription("Description Test");
        $event->setCreationTimestamp($this->getNormalizedTime());
        $event->setUpdateTimestamp($this->getNormalizedTime());
        $event->setSessions([
            [
                "id"        => "123",
                "timestamp" => $this->getNormalizedTime()
            ],
            [
                "id"        => "123",
                "timestamp" => $this->getNormalizedTime()
            ]
        ]);
        $event->setStatus(EVENT::PRIVATE_STATUS);
        $event->setCategories([
            $this->getDefaultCategory()
        ]);
        $event->setAddress($this->getDefaultAddress());
        $event->setUrl("Url Test");
        $event->setProducerId("123");
        $event->setAdminsId(["123"]);
        $event->setSeatingOptions(["Seating Options"]);
        return $event;
    }

    private function getDefaultCategory() {
        $category = new Category();
        $category->setId("123");
        $category->setName("Name Test");
        $category->setSlug("Slug Test");
        $category->setIsPublic(true);
        return $category;
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
        $event = $this->getDefaultEvent();
        $this->assertNull($event->isValid());
    }

    public function testIfIsNotValidWhenIdIsNull() {
        $event = $this->getDefaultEvent();
        $event->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenNameIsNull() {
        $event = $this->getDefaultEvent();
        $event->setName(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenUpdateTsIsNull() {
        $event = $this->getDefaultEvent();
        $event->setUpdateTimestamp(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenProducerIdIsNull() {
        $event = $this->getDefaultEvent();
        $event->setProducerId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenAddressIsNull() {
        $event = $this->getDefaultEvent();
        $event->setAddress(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenSessionsIsNull() {
        $event = $this->getDefaultEvent();
        $event->setSessions(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenSessionsEmptyArray() {
        $event = $this->getDefaultEvent();
        $event->setSessions([]);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenSeatingOptionIsNull() {
        $event = $this->getDefaultEvent();
        $event->setSeatingOptions(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhensetSeatingOptionsEmptyArray() {
        $event = $this->getDefaultEvent();
        $event->setSeatingOptions([]);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenCategoriesIsNull() {
        $event = $this->getDefaultEvent();
        $event->setCategories(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenCategoriesEmptyArray() {
        $event = $this->getDefaultEvent();
        $event->setCategories([]);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenStatusIsNull() {
        $event = $this->getDefaultEvent();
        $event->setStatus(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $event->isValid();
    }


}


?>