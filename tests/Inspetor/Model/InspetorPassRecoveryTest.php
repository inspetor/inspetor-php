<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\InspetorPassRecovery;
use Inspetor\Exception\ModelException\InspetorPassRecoveryException;
use PHPUnit\Framework\TestCase;

class InspetorPassRecoveryTest extends TestCase {

    private function getDefaultPassRecovery() {
        $pass_recovery = new InspetorPassRecovery();
        $pass_recovery->setRecoveryEmail("test@email.com");
        $pass_recovery->setTimestamp($this->getNormalizedTime());
        return $pass_recovery;
    }

    private function getNormalizedTime() {
        return time()*1000;
    }

    public function testIfIsValid() {
        $pass_recovery = $this->getDefaultPassRecovery();
        $this->assertNull($pass_recovery->isValid());
    }

    public function testIfIsNotValidWhenRecoveryEmailIsNull() {
        $pass_recovery = $this->getDefaultPassRecovery();
        $pass_recovery->setRecoveryEmail(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorPassRecoveryException::class);

        $pass_recovery->isValid();
    }

    public function testIfIsNotValidWhenTimestampIsNull() {
        $pass_recovery = $this->getDefaultPassRecovery();
        $pass_recovery->setTimestamp(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorPassRecoveryException::class);

        $pass_recovery->isValid();
    }

}


?>