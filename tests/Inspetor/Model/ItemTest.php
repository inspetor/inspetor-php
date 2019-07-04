<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\Item;
use Inspetor\Exception\ModelException\ItemException;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase {

    private function getDefaultItem() {
        $item = new Item();
        $item->setId("123");
        $item->setEventId("123");
        $item->setSessionId("123");
        $item->setPrice("10");
        $item->setSeatingOption("Seating Option Test");
        $item->setQuantity("123");
        return $item;
    }

    public function testIfIsValid() {
        $item = $this->getDefaultItem();
        $this->assertNull($item->isValid());
    }

    public function testIfIsNotValidWhenIdIsNull() {
        $item = $this->getDefaultItem();
        $item->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(ItemException::class);

        $item->isValid();
    }

    public function testIfIsNotValidWhenEventIdIsNull() {
        $item = $this->getDefaultItem();
        $item->setEventId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(ItemException::class);

        $item->isValid();
    }

    public function testIfIsNotValidWhenSessionIdIsNull() {
        $item = $this->getDefaultItem();
        $item->setSessionId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(ItemException::class);

        $item->isValid();
    }

    public function testIfIsNotValidWhenPriceIsNull() {
        $item = $this->getDefaultItem();

        $this->expectExceptionCode(200);
        $this->setExpectedException(ItemException::class);

        $item->setPrice(null);
    }

    public function testIfIsNotValidWhenQuantityIsNull() {
        $item = $this->getDefaultItem();
        $item->setQuantity(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(ItemException::class);

        $item->isValid();
    }


}


?>