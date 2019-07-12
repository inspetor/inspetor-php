<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\InspetorPayment;
use Inspetor\Exception\ModelException\InspetorPaymentException;
use PHPUnit\Framework\TestCase;

class InspetorPaymentTest extends TestCase {

    private function getDefaultPayment() {
        $payment = new InspetorPayment();
        $payment->setId("123");
        $payment->setMethod(InspetorPayment::BOLETO);
        $payment->setInstallments(1);
        $payment->setCreditCard(null);
        return $payment;
    }

    public function testIfIsValid() {
        $payment = $this->getDefaultPayment();
        $this->assertNull($payment->isValid());
    }

    public function testIfIsNotValidWhenIdIsNull() {
        $payment = $this->getDefaultPayment();
        $payment->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorPaymentException::class);

        $payment->isValid();
    }

    public function testIfIsNotValidWhenMethodIsNull() {
        $payment = $this->getDefaultPayment();
        $payment->setMethod(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorPaymentException::class);

        $payment->isValid();
    }

    public function testIfIsNotValidWhenInstallmentIsNull() {
        $payment = $this->getDefaultPayment();
        $payment->setInstallments(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorPaymentException::class);

        $payment->isValid();
    }

    public function testIfIsNotValidWhenCreditCardMethodNullCreditCardIsNull() {
        $payment = $this->getDefaultPayment();
        $payment->setMethod(InspetorPayment::CREDIT_CARD);
        $payment->setCreditCard(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorPaymentException::class);

        $payment->isValid();
    }


}


?>