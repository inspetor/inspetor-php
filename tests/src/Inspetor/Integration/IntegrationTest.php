<?php

namespace Inspetor\Tests\src\Inspetor\Tracker;

use Inspetor\InspetorClient;
use Inspetor\Tests\src\Inspetor\Tracker\DefaultModels;
use Inspetor\Model\Sale;
use Inspetor\Model\Event;
use Inspetor\Model\Account;
use Inspetor\Model\Auth;
use Inspetor\Model\PassRecovery;
use Inspetor\Model\Transfer;
use Inspetor\Model\Payment;
use Inspetor\Exception\TrackerException;
use Inspetor\Exception\ModelException\SaleException;
use Inspetor\Exception\ModelException\AccountException;
use Inspetor\Exception\ModelException\AuthException;
use Inspetor\Exception\ModelException\EventException;
use Inspetor\Exception\ModelException\PassRecoveryException;
use Inspetor\Exception\ModelException\TransferException;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase {

    private function getDefaultInspetorClient() {
        $inspetor_client = new InspetorClient([
            "appId"         => "123",
            "trackerName"   => "inspetor.php.test"
        ]);
        return $inspetor_client;
    }

    // public function testTrackSaleCreation() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $sale = $default_models->getDefaultSale();

    //     $this->assertTrue($inspetor_client->trackSaleCreation($sale));
    // }

    // public function testTrackSaleCreationWithCreditCard() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $sale = $default_models->getDefaultSale();
        
    //     $payment = $sale->getPayment();
    //     $payment->setMethod(PAYMENT::CREDIT_CARD);
    //     $payment->setCreditCard($default_models->getDefaultCreditCard());

    //     $this->assertTrue($inspetor_client->trackSaleCreation($sale));
    // }

    // public function testTrackSaleUpdate() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $sale = $default_models->getDefaultSale();

    //     $this->assertTrue($inspetor_client->trackSaleUpdate($sale));
    // }

    // public function testTrackAccountCreation() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $account = $default_models->getDefaultAccount();

    //     $this->assertTrue($inspetor_client->trackAccountCreation($account));
    // }

    // public function testTrackAccountUpdate() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $account = $default_models->getDefaultAccount();

    //     $this->assertTrue($inspetor_client->trackAccountUpdate($account));
    // }

    // public function testTrackAccountDeletion() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $account = $default_models->getDefaultAccount();

    //     $this->assertTrue($inspetor_client->trackAccountDeletion($account));
    // }

    public function testTrackEventCreation() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultEvent();

        $this->assertTrue($inspetor_client->trackEventCreation($event));
    }

    public function testTrackEventUpdate() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultEvent();

        $this->assertTrue($inspetor_client->trackEventUpdate($event));
    }

    public function testTrackEventDeletion() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultEvent();

        $this->assertTrue($inspetor_client->trackEventDeletion($event));
    }

    // public function testTrackItemTransferCreation() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $transfer = $default_models->getDefaultTransfer();

    //     $this->assertTrue($inspetor_client->trackItemTransferCreation($transfer));
    // }

    // public function testTrackItemTransferUpdate() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $transfer = $default_models->getDefaultTransfer();

    //     $this->assertTrue($inspetor_client->trackItemTransferUpdate($transfer));
    // }

    // public function testTrackLogin() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $auth = $default_models->getDefaultAuth();

    //     $this->assertTrue($inspetor_client->trackLogin($auth));
    // }

    // public function testTrackLogout() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $auth = $default_models->getDefaultAuth();

    //     $this->assertTrue($inspetor_client->trackLogout($auth));
    // }

    // public function testTrackPasswordRecovery() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $pass_recovery = $default_models->getDefaultPassRecovery();

    //     $this->assertTrue($inspetor_client->trackPasswordRecovery($pass_recovery));
    // }

    // public function testTrackPasswordReset() {
    //     $inspetor_client = $this->getDefaultInspetorClient();
    //     $default_models = new DefaultModels();
    //     $pass_recovery = $default_models->getDefaultPassRecovery();

    //     $this->assertTrue($inspetor_client->trackPasswordReset($pass_recovery));
    // }
}


?>