<?php

namespace Inspetor\Test\Tracker;

use Inspetor\InspetorClient;
use Inspetor\Test\Tracker\DefaultModels;
use Inspetor\Model\InspetorSale;
use Inspetor\Model\InspetorEvent;
use Inspetor\Model\InspetorAccount;
use Inspetor\Model\InspetorAuth;
use Inspetor\Model\InspetorPassRecovery;
use Inspetor\Model\InspetorTransfer;
use Inspetor\Exception\TrackerException;
use Inspetor\Exception\ModelException\InspetorSaleException;
use Inspetor\Exception\ModelException\InspetorAccountException;
use Inspetor\Exception\ModelException\InspetorAuthException;
use Inspetor\Exception\ModelException\InspetorEventException;
use Inspetor\Exception\ModelException\InspetorPassRecoveryException;
use Inspetor\Exception\ModelException\InspetorTransferException;
use PHPUnit\Framework\TestCase;

class InspetorClientTest extends TestCase {

    private function getDefaultInspetorClient() {
        $inspetor_client = new InspetorClient([
            "appId"         => "123",
            "trackerName"   => "123",
            "devEnv"        => true,
            "inspetorEnv"   => true
        ]);
        return $inspetor_client;
    }

    public function testTrackSaleCreation() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $sale = $default_models->getDefaultSale();

        $this->assertTrue($inspetor_client->trackSaleCreation($sale));
    }

    public function testTrackSaleCreationWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $sale = $default_models->getDefaultSale();
        $sale->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSaleException::class);

        $inspetor_client->trackSaleCreation($sale);
    }

    public function testTrackSaleUpdate() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $sale = $default_models->getDefaultUpdateSale();

        $this->assertTrue($inspetor_client->trackSaleUpdate($sale));
    }

    public function testTrackSaleUpdateWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $sale = $default_models->getDefaultSale();
        $sale->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorSaleException::class);

        $inspetor_client->trackSaleUpdate($sale);
    }

    public function testTrackAccountCreation() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $account = $default_models->getDefaultAccount();

        $this->assertTrue($inspetor_client->trackAccountCreation($account));
    }

    public function testTrackAccountCreationWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $account = $default_models->getDefaultAccount();
        $account->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAccountException::class);

        $inspetor_client->trackAccountCreation($account);
    }

    public function testTrackAccountUpdate() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $account = $default_models->getDefaultUpdateAccount();

        $this->assertTrue($inspetor_client->trackAccountUpdate($account));
    }

    public function testTrackAccountUpdateWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $account = $default_models->getDefaultUpdateAccount();
        $account->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAccountException::class);

        $inspetor_client->trackAccountUpdate($account);
    }

    public function testTrackAccountDeletion() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $account = $default_models->getDefaultAccount();

        $this->assertTrue($inspetor_client->trackAccountDeletion($account));
    }

    public function testTrackAccountDeletionWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $account = $default_models->getDefaultUpdateAccount();
        $account->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAccountException::class);

        $inspetor_client->trackAccountDeletion($account);
    }

    public function testTrackEventCreation() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultEvent();

        $this->assertTrue($inspetor_client->trackEventCreation($event));
    }

    public function testTrackEventCreationWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultEvent();
        $event->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorEventException::class);

        $inspetor_client->trackEventCreation($event);
    }

    public function testTrackEventUpdate() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultUpdateEvent();

        $this->assertTrue($inspetor_client->trackEventUpdate($event));
    }

    public function testTrackEventUpdateWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultUpdateEvent();
        $event->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorEventException::class);

        $inspetor_client->trackEventUpdate($event);
    }

    public function testTrackEventDeletion() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultUpdateEvent();

        $this->assertTrue($inspetor_client->trackEventDeletion($event));
    }

    public function testTrackEventDeletionWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultUpdateEvent();
        $event->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorEventException::class);

        $inspetor_client->trackEventDeletion($event);
    }

    public function testTrackItemTransferCreation() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $transfer = $default_models->getDefaultTransfer();

        $this->assertTrue($inspetor_client->trackItemTransferCreation($transfer));
    }

    public function testTrackItemTransferCreationWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $transfer = $default_models->getDefaultTransfer();
        $transfer->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorTransferException::class);

        $inspetor_client->trackItemTransferCreation($transfer);
    }

    public function testTrackItemTransferUpdate() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $transfer = $default_models->getDefaultUpdateTransfer();

        $this->assertTrue($inspetor_client->trackItemTransferUpdate($transfer));
    }

    public function testTrackItemTransferUpdateWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $transfer = $default_models->getDefaultUpdateTransfer();
        $transfer->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorTransferException::class);

        $inspetor_client->trackItemTransferUpdate($transfer);
    }

    public function testTrackLogin() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $auth = $default_models->getDefaultAuth();

        $this->assertTrue($inspetor_client->trackLogin($auth));
    }

    public function testTrackLoginWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $auth = $default_models->getDefaultAuth();
        $auth->setAccountId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAuthException::class);

        $inspetor_client->trackLogin($auth);
    }

    public function testTrackLogout() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $auth = $default_models->getDefaultAuth();

        $this->assertTrue($inspetor_client->trackLogout($auth));
    }

    public function testTrackLogoutWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $auth = $default_models->getDefaultAuth();
        $auth->setAccountId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorAuthException::class);

        $inspetor_client->trackLogout($auth);
    }

    public function testTrackPasswordRecovery() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $pass_recovery = $default_models->getDefaultPassRecovery();

        $this->assertTrue($inspetor_client->trackPasswordRecovery($pass_recovery));
    }

    public function testTrackPasswordRecoveryWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $pass_recovery = $default_models->getDefaultPassRecovery();
        $pass_recovery->setRecoveryEmail(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorPassRecoveryException::class);

        $inspetor_client->trackPasswordRecovery($pass_recovery);
    }

    public function testTrackPasswordReset() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $pass_recovery = $default_models->getDefaultPassRecovery();

        $this->assertTrue($inspetor_client->trackPasswordReset($pass_recovery));
    }

    public function testTrackPasswordResetWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $pass_recovery = $default_models->getDefaultPassRecovery();
        $pass_recovery->setRecoveryEmail(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(InspetorPassRecoveryException::class);

        $inspetor_client->trackPasswordReset($pass_recovery);
    }

    public function testGetInspetorAccount() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorAccount", $inspetor_client->getInspetorAccount());
    }

    public function testGetInspetorAddress() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorAddress", $inspetor_client->getInspetorAddress());
    }

    public function testGetInspetorAuth() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorAuth", $inspetor_client->getInspetorAuth());
    }

    public function testGetInspetorCategory() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorCategory", $inspetor_client->getInspetorCategory());
    }

    public function testGetInspetorCreditCard() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorCreditCard", $inspetor_client->getInspetorCreditCard());
    }

    public function testGetInspetorEvent() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorEvent", $inspetor_client->getInspetorEvent());
    }

    public function testGetInspetorItem() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorItem", $inspetor_client->getInspetorItem());
    }

    public function testGetInspetorPassRecovery() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorPassRecovery", $inspetor_client->getInspetorPassRecovery());
    }

    public function testGetInspetorPayment() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorPayment", $inspetor_client->getInspetorPayment());
    }

    public function testGetInspetorSale() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorSale", $inspetor_client->getInspetorSale());
    }

    public function testGetInspetorSession() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorSession", $inspetor_client->getInspetorSession());
    }

    public function testGetInspetorTransfer() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\InspetorSession", $inspetor_client->getInspetorSession());
    }

}


?>