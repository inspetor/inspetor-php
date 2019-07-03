<?php

namespace Inspetor\Tests\src\Inspetor\Tracker;

use Inspetor\InspetorClient;
use Inspetor\Tests\src\Inspetor\Tracker\DefaultModels;
use Inspetor\Exception\TrackerException;
use PHPUnit\Framework\TestCase;

class InspetorClientTest extends TestCase {

    private function getDefaultInspetorClient() {
        $inspetor_client = new InspetorClient([
            "appId"       => "123",
            "trackerName" => "123"
        ]);
        return $inspetor_client;
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

    public function testGetInspetorCategory() {
        $inspetor_client = $this->getDefaultInspetorClient();
        $this->assertInstanceOf("Inspetor\Model\Category", $inspetor_client->getInspetorCategory());
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