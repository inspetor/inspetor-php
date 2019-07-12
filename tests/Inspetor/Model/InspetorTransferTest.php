<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\InspetorTransfer;
use Inspetor\Exception\ModelException\InspetorTransferException;
use PHPUnit\Framework\TestCase;

class InspetorTransferTest extends TestCase {

    private function getDefaultTransfer() {
        $transfer = new InspetorTransfer();
        $transfer->setId("123");
        $transfer->setTimestamp($this->getNormalizedTime());
        $transfer->setItemId("123");
        $transfer->setSenderAccountId("123");
        $transfer->setReceiverEmail("test@email.com");
        $transfer->setStatus(InspetorTransfer::PENDING_STATUS);
        return $transfer;
    }

    private function getNormalizedTime() {
        return time()*1000;
    }

    public function testIfIsValid() {
        $transfer = $this->getDefaultTransfer();
        $this->assertNull($transfer->isValid());
    }

    public function testIfIsNotValidWhenIdIsNull() {
        $transfer = $this->getDefaultTransfer();
        $transfer->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorTransferException::class);

        $transfer->isValid();
    }

    public function testIfIsNotValidWhenUpdateTimestampIsNull() {
        $transfer = $this->getDefaultTransfer();
        $transfer->setTimestamp(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorTransferException::class);

        $transfer->isValid();
    }

    public function testIfIsNotValidWhenItemIdIsNull() {
        $transfer = $this->getDefaultTransfer();
        $transfer->setItemId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorTransferException::class);

        $transfer->isValid();
    }

    public function testIfIsNotValidWhenSenderAccountIsNull() {
        $transfer = $this->getDefaultTransfer();
        $transfer->setSenderAccountId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorTransferException::class);

        $transfer->isValid();
    }

    public function testIfIsNotValidWhenReceiverEmailIsNull() {
        $transfer = $this->getDefaultTransfer();
        $transfer->setReceiverEmail(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorTransferException::class);

        $transfer->isValid();
    }

    public function testIfIsNotValidWhenStatusIsNotValidIsNull() {
        $transfer = $this->getDefaultTransfer();
        $transfer->setStatus("Not Valid");

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorTransferException::class);

        $transfer->isValid();
    }


}


?>