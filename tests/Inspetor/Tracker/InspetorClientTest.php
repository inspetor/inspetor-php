<?php

namespace Inspetor\Test\Tracker;

use Inspetor\InspetorClient;
use Inspetor\Test\Tracker\DefaultModels;
use Inspetor\Model\Sale;
use Inspetor\Model\Event;
use Inspetor\Model\Account;
use Inspetor\Model\Auth;
use Inspetor\Model\PassRecovery;
use Inspetor\Model\Transfer;
use Inspetor\Exception\TrackerException;
use Inspetor\Exception\ModelException\SaleException;
use Inspetor\Exception\ModelException\AccountException;
use Inspetor\Exception\ModelException\AuthException;
use Inspetor\Exception\ModelException\EventException;
use Inspetor\Exception\ModelException\PassRecoveryException;
use Inspetor\Exception\ModelException\TransferException;
use PHPUnit\Framework\TestCase;

class InspetorClientTest extends TestCase {

    private function getDefaultInspetorClient() {
        $inspetor_client = new InspetorClient([
            "appId"         => "123",
            "trackerName"   => "123",
            'collectorHost' => "test.test",
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
        $this->setExpectedException(SaleException::class);

        $inspetor_client->trackSaleCreation($sale);
    }

    public function testTrackSaleUpdate() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $sale = $default_models->getDefaultSale();

        $this->assertTrue($inspetor_client->trackSaleUpdate($sale));
    }

    public function testTrackSaleUpdateWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $sale = $default_models->getDefaultSale();
        $sale->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(SaleException::class);

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
        $this->setExpectedException(AccountException::class);

        $inspetor_client->trackAccountCreation($account);
    }

    public function testTrackAccountUpdate() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $account = $default_models->getDefaultAccount();

        $this->assertTrue($inspetor_client->trackAccountUpdate($account));
    }

    public function testTrackAccountUpdateWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $account = $default_models->getDefaultAccount();
        $account->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(AccountException::class);

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
        $account = $default_models->getDefaultAccount();
        $account->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(AccountException::class);

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
        $this->setExpectedException(EventException::class);

        $inspetor_client->trackEventCreation($event);
    }

    public function testTrackEventUpdate() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultEvent();

        $this->assertTrue($inspetor_client->trackEventUpdate($event));
    }

    public function testTrackEventUpdateWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultEvent();
        $event->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

        $inspetor_client->trackEventUpdate($event);
    }

    public function testTrackEventDeletion() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultEvent();

        $this->assertTrue($inspetor_client->trackEventDeletion($event));
    }

    public function testTrackEventDeletionWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultEvent();
        $event->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(EventException::class);

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
        $this->setExpectedException(TransferException::class);

        $inspetor_client->trackItemTransferCreation($transfer);
    }

    public function testTrackItemTransferUpdate() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $transfer = $default_models->getDefaultTransfer();

        $this->assertTrue($inspetor_client->trackItemTransferUpdate($transfer));
    }

    public function testTrackItemTransferUpdateWithInvalidObject() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $transfer = $default_models->getDefaultTransfer();
        $transfer->setId(null);

        $this->expectExceptionCode(200);
        $this->setExpectedException(TransferException::class);

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
        $this->setExpectedException(AuthException::class);

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
        $this->setExpectedException(AuthException::class);

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
        $this->setExpectedException(PassRecoveryException::class);

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
        $this->setExpectedException(PassRecoveryException::class);

        $inspetor_client->trackPasswordReset($pass_recovery);
    }

    public function testGetInspetorAccount() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\Account", $inspetor_client->getInspetorAccount());
    }

    public function testGetInspetorAddress() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\Address", $inspetor_client->getInspetorAddress());
    }

    public function testGetInspetorAuth() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\Auth", $inspetor_client->getInspetorAuth());
    }

    public function testGetInspetorCreditCard() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\CreditCard", $inspetor_client->getInspetorCreditCard());
    }

    public function testGetInspetorEvent() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\Event", $inspetor_client->getInspetorEvent());
    }

    public function testGetInspetorItem() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\Item", $inspetor_client->getInspetorItem());
    }

    public function testGetInspetorPassRecovery() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\PassRecovery", $inspetor_client->getInspetorPassRecovery());
    }

    public function testGetInspetorPayment() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\Payment", $inspetor_client->getInspetorPayment());
    }

    public function testGetInspetorSale() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\Sale", $inspetor_client->getInspetorSale());
    }

    public function testGetInspetorTransfer() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\Transfer", $inspetor_client->getInspetorTransfer());
    }


}


?>