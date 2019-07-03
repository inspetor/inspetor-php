<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\Category;
use Inspetor\Exception\ModelException\CategoryException;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase {

    private function getDefaultCategory() {
        $category = new Category();
        $category->setId("123");
        $category->setName("Name Test");
        $category->setSlug("Slug Test");
        $category->setIsPublic(true);
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
        $this->setExpectedException(CategoryException::class);

        $category->isValid();
    }

    public function testIfIsNotValidWhenNameIsNull() {
        $category = $this->getDefaultCategory();
        $category->setName(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(CategoryException::class);

        $category->isValid();
    }

    public function testIfIsNotValidWhenSlugIsNull() {
        $category = $this->getDefaultCategory();
        $category->setSlug(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(CategoryException::class);

        $category->isValid();
    }

    public function testIfIsNotValidWhenIsPublicIsNull() {
        $category = $this->getDefaultCategory();
        $category->setIsPublic(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(CategoryException::class);

        $category->isValid();
    }


}


?>