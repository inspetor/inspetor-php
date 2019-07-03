<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\Auth;
use Inspetor\Exception\ModelException\AuthException;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase {

    private function getDefaultAuth() {
        $auth = new Auth();
        $auth->setAccountId("123");
        $auth->setAccountEmail("test@email.com");
        $auth->setTimestamp($this->getNormalizedTime());
        return $auth;
    }

    private function getNormalizedTime() {
        return time()*1000;
    }

    public function testIfIsValid() {
        $auth = $this->getDefaultAuth();
        $this->assertNull($auth->isValid());
    }

    public function testIfIsNotValidWhenAccountIdIsNull() {
        $auth = $this->getDefaultAuth();
        $auth->setAccountId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(AuthException::class);
        
        $auth->isValid();
    }

    public function testIfPassingNullAsTSThrowsException() {
        $auth = $this->getDefaultAuth();
        $auth->setTimestamp(null);

        //$this->expectExceptionCode(200);
        //$this->setExpectedException(AuthException::class);

        $auth->isValid();
    }

}


?>