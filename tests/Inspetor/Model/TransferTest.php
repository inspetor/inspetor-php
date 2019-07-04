<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\Transfer;
use Inspetor\Exception\ModelException\TransferException;
use PHPUnit\Framework\TestCase;

class TransferTest extends TestCase {

    private function getDefaultTransfer() {
        $transfer = new Transfer();
        $transfer->setId("123");
        $transfer->setCreationTimestamp($this->getNormalizedTime());
        $transfer->setUpdateTimestamp($this->getNormalizedTime());
        $transfer->setItemId("123");
        $transfer->setSenderAccountId("123");
        $transfer->setReceiverEmail("test@email.com");
        $transfer->setStatus(TRANSFER::PENDING_STATUS);
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
        $this->setExpectedException(TransferException::class);

        $transfer->isValid();
    }

    public function testIfIsNotValidWhenUpdateTimestampIsNull() {
        $transfer = $this->getDefaultTransfer();
        $transfer->setUpdateTimestamp(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(TransferException::class);

        $transfer->isValid();
    }

    public function testIfIsNotValidWhenItemIdIsNull() {
        $transfer = $this->getDefaultTransfer();
        $transfer->setItemId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(TransferException::class);

        $transfer->isValid();
    }

    public function testIfIsNotValidWhenSenderAccountIsNull() {
        $transfer = $this->getDefaultTransfer();
        $transfer->setSenderAccountId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(TransferException::class);

        $transfer->isValid();
    }

    public function testIfIsNotValidWhenReceiverEmailIsNull() {
        $transfer = $this->getDefaultTransfer();
        $transfer->setReceiverEmail(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(TransferException::class);

        $transfer->isValid();
    }

    public function testIfIsNotValidWhenStatusIsNotValidIsNull() {
        $transfer = $this->getDefaultTransfer();
        $transfer->setStatus("Not Valid");

        $this->expectExceptionCode(200);
        $this->setExpectedException(TransferException::class);

        $transfer->isValid();
    }


}


?>