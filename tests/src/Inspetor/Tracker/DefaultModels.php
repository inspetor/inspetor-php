<?php

namespace Inspetor\Tests\src\Inspetor\Tracker;

use Inspetor\Model\Account;
use Inspetor\Model\Address;
use Inspetor\Model\Auth;
use Inspetor\Model\Category;
use Inspetor\Model\CreditCard;
use Inspetor\Model\Event;
use Inspetor\Model\Item;
use Inspetor\Model\PassRecovery;
use Inspetor\Model\Payment;
use Inspetor\Model\Sale;
use Inspetor\Model\Transfer;

class DefaultModels {

    public function getDefaultSale() {
        $sale = new Sale();
        $sale->setId("123");
        $sale->setAccountId("123");
        $sale->setStatus(SALE::PENDING_STATUS);
        $sale->setIsFraud(true);
        $sale->setCreationTimestamp($this->getNormalizedTime());
        $sale->setUpdateTimestamp($this->getNormalizedTime());
        $sale->setItems([
            $this->getDefaultItem()
        ]);
        $sale->setPayment($this->getDefaultPayment());
        return $sale;
    }

    public function getDefaultAccount() {
        $account = new Account();
        $account->setId("123");
        $account->setName("Test Name");
        $account->setEmail("test@email.com");
        $account->setDocument("12312312312");
        $account->setPhoneNumber("112345678");
        $account->setAddress($this->getDefaultAddress());
        $account->setBillingAddress($this->getDefaultAddress());
        $account->setCreationTimestamp($this->getNormalizedTime());
        $account->setUpdateTimestamp($this->getNormalizedTime());
        return $account;
    }

    public function getDefaultEvent() {
        $event = new Event();
        $event->setId("123");
        $event->setName("Name Test");
        $event->setDescription("Description Test");
        $event->setCreationTimestamp($this->getNormalizedTime());
        $event->setUpdateTimestamp($this->getNormalizedTime());
        $event->setSessions([
            [
                "id"        => "123",
                "timestamp" => $this->getNormalizedTime()
            ],
            [
                "id"        => "123",
                "timestamp" => $this->getNormalizedTime()
            ]
        ]);
        $event->setStatus(EVENT::PRIVATE_STATUS);
        $event->setCategories([
            $this->getDefaultCategory()
        ]);
        $event->setAddress($this->getDefaultAddress());
        $event->setUrl("Url Test");
        $event->setProducerId("123");
        $event->setAdminsId(["123"]);
        $event->setSeatingOptions(["Seating Options"]);
        return $event;
    }

    public function getDefaultTransfer() {
        $transfer = new Transfer();
        $transfer->setId("123");
        $transfer->setTimestamp($this->getNormalizedTime());
        $transfer->setItemId("123");
        $transfer->setSenderAccountId("123");
        $transfer->setReceiverEmail("test@email.com");
        $transfer->setStatus(TRANSFER::PENDING_STATUS);
        return $transfer;
    }

    public function getDefaultAuth() {
        $auth = new Auth();
        $auth->setAccountId("123");
        $auth->setAccountEmail("test@email.com");
        $auth->setTimestamp($this->getNormalizedTime());
        return $auth;
    }

    public function getDefaultPassRecovery() {
        $pass_recovery = new PassRecovery();
        $pass_recovery->setRecoveryEmail("test@email.com");
        $pass_recovery->setTimestamp($this->getNormalizedTime());
        return $pass_recovery;
    }

    public function getDefaultCategory() {
        $category = new Category();
        $category->setId("123");
        $category->setName("Name Test");
        $category->setSlug("Slug Test");
        $category->setIsPublic(true);
        return $category;
    }

    public function getDefaultAddress() {
        $address = new Address();
        $address->setStreet("Test Street");
        $address->setNumber("123");
        $address->setZipCode("123456");
        $address->setCity("Test City");
        $address->setState("Test State");
        $address->setCountry("Test Country");
        $address->setLatitude("123");
        $address->setLongitude("123");
        return $address;
    }

    public function getDefaultItem() {
        $item = new Item();
        $item->setId("123");
        $item->setEventId("123");
        $item->setSessionId("123");
        $item->setPrice("10");
        $item->setSeatingOption("Seating Option Test");
        $item->setQuantity("123");
        return $item;
    }

    public function getDefaultPayment() {
        $payment = new Payment();
        $payment->setId("123");
        $payment->setMethod(PAYMENT::BOLETO);
        $payment->setInstallments("1");
        $payment->setCreditCard(null);
        return $payment;
    }

    public function getNormalizedTime() {
        return time()*1000;
    }

}


?>