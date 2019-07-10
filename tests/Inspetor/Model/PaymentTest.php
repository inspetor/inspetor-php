<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\Payment;
use Inspetor\Exception\ModelException\PaymentException;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase {

    private function getDefaultPayment() {
        $payment = new Payment();
        $payment->setId("123");
        $payment->setMethod(PAYMENT::BOLETO);
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
        $this->setExpectedException(PaymentException::class);

        $payment->isValid();
    }

    public function testIfIsNotValidWhenMethodIsNull() {
        $payment = $this->getDefaultPayment();
        $payment->setMethod(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(PaymentException::class);

        $payment->isValid();
    }

    public function testIfIsNotValidWhenInstallmentIsNull() {
        $payment = $this->getDefaultPayment();
        $payment->setInstallments(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(PaymentException::class);

        $payment->isValid();
    }

    public function testIfIsNotValidWhenCreditCardMethodNullCreditCardIsNull() {
        $payment = $this->getDefaultPayment();
        $payment->setMethod(PAYMENT::CREDIT_CARD);
        $payment->setCreditCard(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(PaymentException::class);

        $payment->isValid();
    }


}


?>