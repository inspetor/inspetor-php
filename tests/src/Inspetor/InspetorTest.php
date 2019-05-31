<?php

namespace Ingresse\Test\Inspetor;

use Inspetor\InspetorClient;
use Inspetor\Exception\TrackerException;
use Ingresse\Test\Inspetor\NonSerializableTestClass;
use PHPUnit\Framework\TestCase;

class InspetorTest extends TestCase
{
    /**
     * @var array
     */
    protected $config;

    public function setUp() {
        $this->config = array(
            'collectorHost' => 'testdomain.com',
            'protocol' => 'https',
            'emitMethod' => 'POST',
            'bufferSize' => 50,
            'trackerName' => null,
            'appId' => null,
            'encode64' => true,
            'debugMode' => false,
            'ingresseAccountSchema' => 'iglu:com.inspetor/ingresse_account/jsonschema/1-0-0',
            'ingresseOrderSchema' => 'iglu:com.inspetor/ingresse_order/jsonschema/1-0-9',
            'ingresseSaleSchema' => 'iglu:com.inspetor/ingresse_sale/jsonschema/1-0-7',
            'ingresseOrderContext' => 'iglu:com.inspetor/ingresse_order_context/jsonschema/1-0-0',
            'ingresseSerializationError' => 'iglu:com.inspetor/ingresse_serialization_error/jsonschema/1-0-0'
        );
    }
}
    /**
     * @covers Inspetor\InspetorClient
     * @expectedException \Exception\TrackerException
     */
//     public function testTrackerSetupMissingParameter() {
//         $client = $this->createMock(
//             'Inspetor\InspetorClient'
//         );
//         $client
//             ->expects($this->once())
//             ->method('setupConfig')
//             ->with(array("appId" => 1))
//             ->will($this->throwException(new TrackerException()));
//     }
// }
