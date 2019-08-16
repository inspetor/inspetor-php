<?php

namespace Inspetor\Test\Tracker;

use Inspetor\Model\InspetorAccount;
use Inspetor\Model\InspetorAddress;
use Inspetor\Model\InspetorAuth;
use Inspetor\Model\InspetorCategory;
use Inspetor\Model\InspetorCreditCard;
use Inspetor\Model\InspetorEvent;
use Inspetor\Model\InspetorItem;
use Inspetor\Model\InspetorPassRecovery;
use Inspetor\Model\InspetorPayment;
use Inspetor\Model\InspetorSale;
use Inspetor\Model\InspetorSession;
use Inspetor\Model\InspetorTransfer;

class DefaultModels {

    public function getDefaultSale() {
        $sale = new InspetorSale();
        $sale->setId("123");
        $sale->setAccountId("123");
        $sale->setStatus(InspetorSale::PENDING_STATUS);
        $sale->setIsFraud(true);
        $sale->setTimestamp(time());
        $sale->setItems([
            $this->getDefaultItem()
        ]);
        $sale->setPayment($this->getDefaultPayment());
        $sale->setAnalyzedBy("sift");
        return $sale;
    }

    public function getDefaultUpdateSale() {
        $sale = new InspetorSale();
        $sale->setId("123");
        $sale->setTimestamp(time());
        $sale->setIsFraud(true);
        $sale->setAnalyzedBy("sift");
        return $sale;
    }

    public function getDefaultAccount() {
        $account = new InspetorAccount();
        $account->setId("123");
        $account->setName("Test Name");
        $account->setEmail("test@email.com");
        $account->setDocument("12312312312");
        $account->setPhoneNumber("112345678");
        $account->setAddress($this->getDefaultAddress());
        $account->setTimestamp(time());
        return $account;
    }

    public function getDefaultUpdateAccount() {
        $account = new InspetorAccount();
        $account->setId("123");
        $account->setTimestamp(time());
        return $account;
    }

    public function getDefaultEvent() {
        $event = new InspetorEvent();
        $event->setId("123");
        $event->setName("Name Test");
        $event->setDescription("Description Test");
        $event->setTimestamp(time());
        $event->setSessions([$this->getDefaultSession()]);
        $event->setStatus(InspetorEvent::PRIVATE_STATUS);
        $event->setCategories([$this->getDefaultCategory()]);
        $event->setAddress($this->getDefaultAddress());
        $event->setSlug("Slug Test");
        $event->setCreatorId("123");
        $event->setAdminsId(["123"]);
        $event->setSeatingOptions(["Seating Options"]);
        return $event;
    }

    public function getDefaultUpdateEvent() {
        $event = new InspetorEvent();
        $event->setId("123");
        $event->setTimestamp(time());
        return $event;
    }

    public function getDefaultTransfer() {
        $transfer = new InspetorTransfer();
        $transfer->setId("123");
        $transfer->setTimestamp(time());
        $transfer->setItemId("123");
        $transfer->setSenderAccountId("123");
        $transfer->setReceiverEmail("test@email.com");
        $transfer->setStatus(InspetorTransfer::PENDING_STATUS);
        return $transfer;
    }

    public function getDefaultUpdateTransfer() {
        $transfer = new InspetorTransfer();
        $transfer->setId("123");
        $transfer->setTimestamp(time());
        return $transfer;
    }

    public function getDefaultAuth() {
        $auth = new InspetorAuth();
        $auth->setAccountEmail("test@email.com");
        $auth->setTimestamp(time());
        $auth->setAccountId("123");
        return $auth;
    }

    public function getDefaultCategory() {
        $category = new InspetorCategory();
        $category->setId("123");
        $category->setName("Category");
        return $category;
    }

    public function getDefaultSession() {
        $session = new InspetorSession();
        $session->setId("123");
        $session->setDatetime(1562934682);
        return $session;
    }

    public function getDefaultPassRecovery() {
        $pass_recovery = new InspetorPassRecovery();
        $pass_recovery->setRecoveryEmail("test@email.com");
        $pass_recovery->setTimestamp(time());
        return $pass_recovery;
    }

    public function getDefaultCreditCard() {
        $credit_card = new InspetorCreditCard();
        $credit_card->setFirstSixDigits("123456");
        $credit_card->setLastFourDigits("1234");
        $credit_card->setHolderName("Holder Name Test");
        $credit_card->setHolderCpf("Holder CPF Test");
        $credit_card->setBillingAddress($this->getDefaultAddress());
        return $credit_card;
    }

    public function getDefaultAddress() {
        $address = new InspetorAddress();
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
        $item = new InspetorItem();
        $item->setId("123");
        $item->setEventId("123");
        $item->setSessionId("123");
        $item->setPrice("10");
        $item->setSeatingOption("Seating Option Test");
        $item->setQuantity("123");
        return $item;
    }

    public function getDefaultPayment() {
        $payment = new InspetorPayment();
        $payment->setId("123");
        $payment->setMethod(InspetorPayment::BOLETO);
        $payment->setInstallments("1");
        $payment->setCreditCard(null);
        return $payment;
    }

    public function getNormalizedTime() {
        return time()*1000;
    }

}


?>