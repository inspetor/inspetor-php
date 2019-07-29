<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\InspetorAuth;
use Inspetor\Exception\ModelException\InspetorAuthException;
use PHPUnit\Framework\TestCase;

class InspetorAuthTest extends TestCase {

    private function getDefaultAuth() {
        $auth = new InspetorAuth();
        $auth->setAccountId("123");
        $auth->setTimestamp(time());
        $auth->setSucceeded(true);
        return $auth;
    }

    public function testIfIsValid() {
        $auth = $this->getDefaultAuth();
        $this->assertNull($auth->isValid());
    }

    public function testIfIsNotValidWhenAccountIdIsNull() {
        $auth = $this->getDefaultAuth();
        $auth->setAccountId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAuthException::class);

        $auth->isValid();
    }

    public function testIfIsNotValidWhenTimestampIsNull() {
        $auth = $this->getDefaultAuth();
        $auth->setTimestamp(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAuthException::class);

        $auth->isValid();
    }

    public function testIfIsNotValidWhenSucceededIsNull() {
        $auth = $this->getDefaultAuth();
        $auth->setSucceeded(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAuthException::class);

        $auth->isValid();
    }

}


?>