<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\InspetorSession;
use Inspetor\Exception\ModelException\InspetorSessionException;
use PHPUnit\Framework\TestCase;

class InspetorSessionTest extends TestCase {

    private function getDefaultSession() {
        $category = new InspetorSession();
        $category->setId("123");
        $category->setDatetime(1562934682);
        return $category;
    }

    public function testIfIsValid() {
        $category = $this->getDefaultSession();
        $this->assertNull($category->isValid());
    }

    public function testIfIsNotValidWhenIdIsNull() {
        $category = $this->getDefaultSession();
        $category->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSessionException::class);

        $category->isValid();
    }

    public function testIfIsNotValidWhenDatetimeIsNull() {
        $category = $this->getDefaultSession();
        $category->setDatetime(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSessionException::class);

        $category->isValid();
    }

}


?>