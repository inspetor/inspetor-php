<?php

namespace Inspetor\Test\Model;

use Inspetor\Model\InspetorSale;
use Inspetor\Model\InspetorItem;
use Inspetor\Model\InspetorPayment;
use Inspetor\Exception\ModelException\InspetorSaleException;
use PHPUnit\Framework\TestCase;

class InspetorSaleTest extends TestCase {

    private function getDefaultSale() {
        $sale = new InspetorSale();
        $sale->setId("123");
        $sale->setAccountId("123");
        $sale->setStatus(InspetorSale::PENDING_STATUS);
        $sale->setIsFraud(true);
        $sale->setAnalyzedBy("sift");
        $sale->setTimestamp(time());
        $sale->setItems([
            $this->getDefaultItem()
        ]);
        $sale->setPayment($this->getDefaultPayment());
        return $sale;
    }

    private function getDefaultItem() {
        $item = new InspetorItem();
        $item->setId("123");
        $item->setEventId("123");
        $item->setSessionIds("123");
        $item->setPrice("10");
        $item->setSeatingOption("Seating Option Test");
        $item->setQuantity("123");
        return $item;
    }

    private function getDefaultPayment() {
        $payment = new InspetorPayment();
        $payment->setId("123");
        $payment->setMethod(InspetorPayment::BOLETO);
        $payment->setInstallments("1");
        $payment->setCreditCard(null);
        return $payment;
    }

    public function testIfIsValid() {
        $sale = $this->getDefaultSale();
        $this->assertNull($sale->isValid());
    }

    public function testIfIsNotValidWhenIdIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenAccountIdIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setAccountId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenStatusIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setStatus(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenStatusIsNotValidIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setStatus("not valid");

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenIsFraudIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setIsFraud(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSaleException::class);

        $sale->isValidUpdate();
    }

    public function testIfIsNotValidWhenItemsIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setItems(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenItemsIsAnEmptyArray() {
        $sale = $this->getDefaultSale();
        $sale->setItems([]);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenPaymentIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setPayment(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSaleException::class);

        $sale->isValid();
    }

    public function testIfIsNotValidWhenAnalysedByIsNull() {
        $sale = $this->getDefaultSale();
        $sale->setAnalyzedBy(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSaleException::class);

        $sale->isValidUpdate();
    }
}


?>