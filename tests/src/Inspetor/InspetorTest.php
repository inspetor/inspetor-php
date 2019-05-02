<?php

namespace Ingresse\Test\Inspetor;

use Ingresse\Inspetor\Inspetor;
use Ingresse\Test\Inspetor\NonSerializableTestClass;
use PHPUnit\Framework\TestCase;

class InspetorTest extends TestCase
{
    protected $config;

    public function setUp() {
        $this->config = array(
            'collectorHost' => 'testdomain.com',
            'protocol' => 'https',
            'emitMethod' => 'POST',
            'bufferSize' => 50,
            'trackerName' => 'ingresse.api',
            'appId' => 'test',
            'encode64' => TRUE,
            'debugMode' => FALSE,
            'ingresseAccountSchema' => 'iglu:com.inspetor/ingresse_account/jsonschema/1-0-0',
            'ingresseOrderSchema' => 'iglu:com.inspetor/ingresse_order/jsonschema/1-0-9',
            'ingresseSaleSchema' => 'iglu:com.inspetor/ingresse_sale/jsonschema/1-0-7',
            'ingresseOrderContext' => 'iglu:com.inspetor/ingresse_order_context/jsonschema/1-0-0',
            'ingresseSerializationError' => 'iglu:com.inspetor/ingresse_serialization_error/jsonschema/1-0-0'
        );
    }

    /**
     * @covers Ingresse\Inspetor\Inspetor
     */
    public function testTrackerFlushesEventsBeforeDestruction() {
        # Setup
        $inspetor = $this->getMockBuilder('\Ingresse\Inspetor\Inspetor')
            ->setConstructorArgs(array($this->config))
            ->setMethods(array('flush'))
            ->getMock();

        # Expectation
        $inspetor->expects($this->once())
            ->method('flush');

        # Action
        $inspetor->__destruct();
    }

    /**
     * @covers Ingresse\Inspetor\Inspetor
     */
    public function testReportsNonJsonSerializableObjectsGracefully() {
        # Setup
        $inspetor = $this->getMockBuilder('\Ingresse\Inspetor\Inspetor')
            ->setConstructorArgs([$this->config])
            ->setMethods(['reportNonserializableCall'])
            ->getMock();

        $nonSerializableObject = new NonSerializableTestClass();

        # Expectation
        $inspetor->expects($this->once())
            ->method('reportNonserializableCall')
            ->with($this->config['ingresseOrderSchema']);

        # Action
        $this->invokeMethod(
            $inspetor,
            'trackUnstructuredEvent',
            array(
                $this->config['ingresseOrderSchema'],
                $nonSerializableObject,
                $this->config['ingresseOrderContext'],
                "action"
            )
        );
    }

    /**
     * @covers Ingresse\Inspetor\Inspetor
     */
    public function testReportsNonJsonSerializableWithTimestamp() {
        # Setup
        $inspetor = $this->getMockBuilder('\Ingresse\Inspetor\Inspetor')
            ->setConstructorArgs([$this->config])
            ->setMethods(['getNormalizedTimestamp'])
            ->getMock();

        $nonSerializableObject = new NonSerializableTestClass();

        # Expectation
        $inspetor->expects($this->once())
            ->method('getNormalizedTimestamp');

        # Action
        $this->invokeMethod(
            $inspetor,
            'reportNonserializableCall',
            array(
                $this->config['ingresseOrderSchema']
            )
        );
    }

    /**
     * Helper method to call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
