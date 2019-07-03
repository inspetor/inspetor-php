<?php

namespace Inspetor\Tests\src\Inspetor\Tracker;

use Inspetor\InspetorResource;
use Inspetor\Tests\src\Inspetor\Tracker\DefaultModels;
use Inspetor\Exception\TrackerException;
use PHPUnit\Framework\TestCase;

class InspetorResourceTest extends TestCase {

    private $default_models;

    private function getDefaultTracker() {
        $inspetor_resource = new InspetorResource([
            "appId"       => "123",
            "trackerName" => "123"
        ]);
        $this->default_models = new DefaultModels();
        return $inspetor_resource;
    }

    public function testTrackSaleActionWithInvalidAction() {
        $inspetor_resource = $this->getDefaultTracker();
        $sale = $this->default_models->getDefaultSale();

        $this->expectExceptionCode(200);
        $this->setExpectedException(TrackerException::class);

        $inspetor_resource->trackSaleAction($sale, "not valid");
    }

    public function testTrackAccountActionWithInvalidAction() {
        $inspetor_resource = $this->getDefaultTracker();
        $account = $this->default_models->getDefaultAccount();

        $this->expectExceptionCode(200);
        $this->setExpectedException(TrackerException::class);

        $inspetor_resource->trackAccountAction($account, "not valid");
    }

    public function testTrackEventActionWithInvalidAction() {
        $inspetor_resource = $this->getDefaultTracker();
        $event = $this->default_models->getDefaultEvent();

        $this->expectExceptionCode(200);
        $this->setExpectedException(TrackerException::class);

        $inspetor_resource->trackEventAction($event, "not valid");
    }

    public function testTrackItemTransferActionWithInvalidAction() {
        $inspetor_resource = $this->getDefaultTracker();
        $transfer = $this->default_models->getDefaultTransfer();

        $this->expectExceptionCode(200);
        $this->setExpectedException(TrackerException::class);

        $inspetor_resource->trackItemTransferAction($transfer, "not valid");
    }

    public function testTrackAccountAuthActionWithInvalidAction() {
        $inspetor_resource = $this->getDefaultTracker();
        $auth = $this->default_models->getDefaultAuth();

        $this->expectExceptionCode(200);
        $this->setExpectedException(TrackerException::class);

        $inspetor_resource->trackAccountAuthAction($auth, "not valid");
    }

    public function testTrackPassRecoveyActionWithInvalidAction() {
        $inspetor_resource = $this->getDefaultTracker();
        $pass_recovery = $this->default_models->getDefaultPassRecovery();

        $this->expectExceptionCode(200);
        $this->setExpectedException(TrackerException::class);

        $inspetor_resource->trackPasswordRecoveryAction($pass_recovery, "not valid");
    }

    public function testSetupConfigWithoutValidConfigArray() {
        $this->expectExceptionCode(200);
        $this->setExpectedException(TrackerException::class);

        $inspetor_resource = new InspetorResource([]);
    }
    


}


?>