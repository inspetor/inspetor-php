<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\InspetorCategory;
use Inspetor\Exception\ModelException\InspetorCategoryException;
use PHPUnit\Framework\TestCase;

class InspetorCategoryTest extends TestCase {

    private function getDefaultCategory() {
        $category = new InspetorCategory();
        $category->setId("123");
        $category->setName("Category");
        return $category;
    }

    public function testIfIsValid() {
        $category = $this->getDefaultCategory();
        $this->assertNull($category->isValid());
    }

    public function testIfIsNotValidWhenIdIsNull() {
        $category = $this->getDefaultCategory();
        $category->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorCategoryException::class);

        $category->isValid();
    }

    public function testIfIsNotValidWhenNameIsNull() {
        $category = $this->getDefaultCategory();
        $category->setName(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorCategoryException::class);

        $category->isValid();
    }

}


?>