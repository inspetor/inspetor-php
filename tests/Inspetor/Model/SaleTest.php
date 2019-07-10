<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\Sale;
use Inspetor\Model\Item;
use Inspetor\Model\Payment;
use Inspetor\Exception\ModelException\SaleException;
use PHPUnit\Framework\TestCase;

class SaleTest extends TestCase {

    private function getDefaultSale() {
        $sale = new Sale();
        $sale->setId("123");
        $sale->setAccountId("123");
        $sale->setStatus(SALE::PENDING_STATUS);
        $sale->setIsFraud(true);
        $sale->setTimestamp($this->getNormalizedTime());
        $sale->setItems([
            $this->getDefaultItem()
        ]);
        $sale->setPayment($this->getDefaultPayment());
        return $sale;
    }

    private function getDefaultItem() {
        $item = new Item();
        $item->setId("123");
        $item->setEventId("123");
        $item->setSessionId("123");
        $item->setPrice("10");
        $item->setSeatingOption("Seating Option Test");
        $item->setQuantity("123");
        return $item;
    }

    private function getDefaultPayment() {
        $payment = new Payment();
        $payment->setId("123");
        $payment->setMethod(PAYMENT::BOLETO);
        $payment->setInstallments("1");
        $payment->setCreditCard(null);
        return $payment;
    }

    private function getNormalizedTime() {
        return time()*1000;
    }


    public function testIfIsValid() {
        $sale = $this->getDefaultSale();
        $this->assertNull($sale->isValid());
    }

    public function testIfIsNotValidWhenIdIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(SaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenAccountIdIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setAccountId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(SaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenStatusIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setStatus(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(SaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenStatusIsNotValidIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setStatus("not valid");

        $this->expectExceptionCode(200);
        $this->setExpectedException(SaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenIsFraudIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setIsFraud(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(SaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenItemsIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setItems(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(SaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenItemsIsAnEmptyArray() {
        $sale = $this->getDefaultSale();
        $sale->setItems([]);

        $this->expectExceptionCode(200);
        $this->setExpectedException(SaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenPaymentIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setPayment(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(SaleException::class);

        $sale->isValid();
    }

}


?>