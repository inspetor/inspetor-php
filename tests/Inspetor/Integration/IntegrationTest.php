<?php

namespace Inspetor\Tests\src\Inspetor\Tracker;

use Inspetor\InspetorClient;
use Inspetor\Test\Tracker\DefaultModels;
use Inspetor\Model\InspetorSale;
use Inspetor\Model\InspetorEvent;
use Inspetor\Model\InspetorAccount;
use Inspetor\Model\InspetorAuth;
use Inspetor\Model\InspetorPassRecovery;
use Inspetor\Model\InspetorTransfer;
use Inspetor\Model\InspetorPayment;
use Inspetor\Exception\TrackerException;
use Inspetor\Exception\ModelException\InspetorSaleException;
use Inspetor\Exception\ModelException\InspetorAccountException;
use Inspetor\Exception\ModelException\InspetorAuthException;
use Inspetor\Exception\ModelException\InspetorEventException;
use Inspetor\Exception\ModelException\InspetorPassRecoveryException;
use Inspetor\Exception\ModelException\InspetorTransferException;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase {

    private function getDefaultInspetorClient() {
        $inspetor_client = new InspetorClient([
            "appId"         => "123",
            "trackerName"   => "inspetor.php.test"
        ]);
        return $inspetor_client;
    }

     public function testTrackSaleCreation() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $sale = $default_models->getDefaultSale();

         $this->assertTrue($inspetor_client->trackSaleCreation($sale));
     }

     public function testTrackSaleCreationWithCreditCard() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $sale = $default_models->getDefaultSale();

         $payment = $sale->getPayment();
         $payment->setMethod(InspetorPayment::CREDIT_CARD);
         $payment->setCreditCard($default_models->getDefaultCreditCard());

         $this->assertTrue($inspetor_client->trackSaleCreation($sale));
     }

     public function testTrackSaleUpdate() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $sale = $default_models->getDefaultUpdateSale();

         $this->assertTrue($inspetor_client->trackSaleUpdate($sale));
     }

     public function testTrackAccountCreation() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $account = $default_models->getDefaultAccount();

         $this->assertTrue($inspetor_client->trackAccountCreation($account));
     }

     public function testTrackAccountUpdate() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $account = $default_models->getDefaultUpdateAccount();

         $this->assertTrue($inspetor_client->trackAccountUpdate($account));
     }

     public function testTrackAccountDeletion() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $account = $default_models->getDefaultAccount();

         $this->assertTrue($inspetor_client->trackAccountDeletion($account));
     }

    public function testTrackEventCreation() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $default_models = new DefaultModels();
        $event = $default_models->getDefaultEvent();

        $this->assertTrue($inspetor_client->trackEventCreation($event));
    }

     public function testTrackEventUpdate() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $event = $default_models->getDefaultUpdateEvent();

         $this->assertTrue($inspetor_client->trackEventUpdate($event));
     }

     public function testTrackEventDeletion() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $event = $default_models->getDefaultUpdateEvent();

         $this->assertTrue($inspetor_client->trackEventDeletion($event));
     }

     public function testTrackItemTransferCreation() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $transfer = $default_models->getDefaultTransfer();

         $this->assertTrue($inspetor_client->trackItemTransferCreation($transfer));
     }

     public function testTrackItemTransferUpdate() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $transfer = $default_models->getDefaultUpdateTransfer();

         $this->assertTrue($inspetor_client->trackItemTransferUpdate($transfer));
     }

     public function testTrackLogin() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $auth = $default_models->getDefaultAuth();

         $this->assertTrue($inspetor_client->trackLogin($auth));
     }

     public function testTrackLogout() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $auth = $default_models->getDefaultAuth();

         $this->assertTrue($inspetor_client->trackLogout($auth));
     }

     public function testTrackPasswordRecovery() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $pass_recovery = $default_models->getDefaultPassRecovery();

         $this->assertTrue($inspetor_client->trackPasswordRecovery($pass_recovery));
     }

     public function testTrackPasswordReset() {
         $inspetor_client = $this->getDefaultInspetorClient();
         $default_models = new DefaultModels();
         $pass_recovery = $default_models->getDefaultPassRecovery();

         $this->assertTrue($inspetor_client->trackPasswordReset($pass_recovery));
     }
}


?>