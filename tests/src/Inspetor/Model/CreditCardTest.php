<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\CreditCard;
use Inspetor\Exception\ModelException\CreditCardException;
use PHPUnit\Framework\TestCase;

class CreditCardTest extends TestCase {

    private function getDefaultCreditCard() {
        $credit_card = new CreditCard();
        $credit_card->setFirstSixDigits("123456");
        $credit_card->setLastFourDigits("1234");
        $credit_card->setHolderName("Holder Name Test");
        $credit_card->setHolderCpf("Holder CPF Test");
        return $credit_card;
    }

    public function testIfIsValid() {
        $credit_card = $this->getDefaultCreditCard();
        $this->assertNull($credit_card->isValid());
    }

    public function testIfIsNotValidWhenFirstSixIsNull() {
        $credit_card = $this->getDefaultCreditCard();
        $credit_card->setFirstSixDigits(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(CreditCardException::class);

        $credit_card->isValid();
    }

    public function testIfIsNotValidWhenLastFourIsNull() {
        $credit_card = $this->getDefaultCreditCard();
        $credit_card->setLastFourDigits(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(CreditCardException::class);

        $credit_card->isValid();
    }

    public function testIfIsNotValidWhenHolderNameIsNull() {
        $credit_card = $this->getDefaultCreditCard();
        $credit_card->setHolderName(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(CreditCardException::class);

        $credit_card->isValid();
    }

    public function testIfIsNotValidWhenHolderCpfIsNull() {
        $credit_card = $this->getDefaultCreditCard();
        $credit_card->setHolderCpf(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(CreditCardException::class);

        $credit_card->isValid();
    }


}


?>