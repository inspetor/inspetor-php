<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\InspetorAuth;
use Inspetor\Exception\ModelException\InspetorAuthException;
use PHPUnit\Framework\TestCase;

class InspetorAuthTest extends TestCase {

    private function getDefaultAuth() {
        $auth = new InspetorAuth();
        $auth->setAccountEmail("123");
        $auth->setTimestamp(time());
        $auth->setAccountId("123");
        return $auth;
    }

    public function testIfIsValid() {
        $auth = $this->getDefaultAuth();
        $this->assertNull($auth->isValid());
    }

    public function testIfIsNotValidWhenAccountEmailIsNull() {
        $auth = $this->getDefaultAuth();
        $auth->setAccountEmail(null);

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

}


?>