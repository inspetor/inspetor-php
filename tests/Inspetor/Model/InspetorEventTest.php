<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\InspetorAddress;
use Inspetor\Model\InspetorCategory;
use Inspetor\Model\InspetorEvent;
use Inspetor\Model\InspetorSession;
use Inspetor\Exception\ModelException\InspetorEventException;
use PHPUnit\Framework\TestCase;

class InspetorEventTest extends TestCase {

    private function getDefaultEvent() {
        $event = new InspetorEvent();
        $event->setId("123");
        $event->setName("Name Test");
        $event->setDescription("Description Test");
        $event->setTimestamp(time());
        $event->setSessions([$this->getDefaultSession()]);
        $event->setStatus(InspetorEvent::PRIVATE_STATUS);
        $event->setCategories([$this->getDefaultCategory()]);
        $event->setAddress($this->getDefaultAddress());
        $event->setSlug("Slug Test");
        $event->setCreatorId("123");
        $event->setAdminsId(["123"]);
        $event->setSeatingOptions(["Seating Options"]);
        return $event;
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

    private function getDefaultCategory() {
        $category = new InspetorCategory();
        $category->setId("123");
        $category->setName("Category");
        return $category;
    }

    private function getDefaultSession() {
        $session = new InspetorSession();
        $session->setId("123");
        $session->setDatetime(1562934682);
        return $session;
    }

    public function testIfIsValid() {
        $event = $this->getDefaultEvent();
        $this->assertNull($event->isValid());
    }

    public function testIfIsNotValidWhenIdIsNull() {
        $event = $this->getDefaultEvent();
        $event->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorEventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenNameIsNull() {
        $event = $this->getDefaultEvent();
        $event->setName(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorEventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenUpdateTsIsNull() {
        $event = $this->getDefaultEvent();
        $event->setTimestamp(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorEventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenCreatorIdIsNull() {
        $event = $this->getDefaultEvent();
        $event->setCreatorId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorEventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenAddressIsNull() {
        $event = $this->getDefaultEvent();
        $event->setAddress(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorEventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenAddressIsNullEventNotPhysical() {
        $event = $this->getDefaultEvent();
        $event->setAddress(null);
        $event->setIsPhysical(true);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorEventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenSessionsEmptyArray() {
        $event = $this->getDefaultEvent();
        $event->setSessions([]);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorEventException::class);

        $event->isValid();
    }

    public function testIfIsNotValidWhenAdminsIdIsNull() {
        $event = $this->getDefaultEvent();
        $event->setAdminsId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorEventException::class);

        $event->isValid();
    }


}


?>