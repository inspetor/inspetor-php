<?php

namespace Ingresse\Inspetor;

use Snowplow\Tracker\Tracker;
use Snowplow\Tracker\Subject;
use Snowplow\Tracker\Emitters\SyncEmitter;
use Ingresse\Middleware\Service\RequestContext;
use Ingresse\Domain\Entity\Sale;
use Ingresse\Domain\Entity\User;
use Ingresse\Store\Order\Order;
use JsonSerializable;

class Inspetor
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var Snowplow\Tracker\Emitters\SyncEmitter;
     */
    private $emitter;

    /**
     * @var Snowplow\Tracker\Subject;
     */
    private $subject;

    /**
     * @var Snowplow\Tracker\Tracker;
     */
    private $tracker;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->emitter = new SyncEmitter(
            $this->config['collectorHost'],
            $this->config['protocol'],
            $this->config['emitMethod'],
            $this->config['bufferSize'],
            $this->config['debugMode']
        );
        $this->subject = new Subject();
        $this->tracker = new Tracker(
            $this->emitter,
            $this->subject,
            $this->config['trackerName'],
            $this->config['appId'],
            $this->config['encode64']
        );
    }

    /**
     * @param string $schema  Iglu identifier of custom event schema
     * @param object $data    Should implement JsonSerializable
     * @param string $context Iglu identifier of custom event context
     * @param string $action  Define context function
     */
    private function trackUnstructuredEvent($schema, $data, $context, $action)
    {
        if (!($data instanceof JsonSerializable)) {
            $this->reportNonserializableCall($schema);
            return;
        }
        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $schema,
                "data" => ($data->jsonSerialize())
            ),
            array(
                array(
                    "schema" => $context,
                    "data" => array(
                        "action" => $action
                    )
                )
            ),
            $this->getNormalizedTimestamp()
        );
    }

    /**
     * Public for testing
     *
     * @param string $schema Iglu identifier of custom event schema
     */
    public function reportNonserializableCall($schema)
    {
        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->config['ingresseSerializationError'],
                "data" => (['intendedSchemaId' => $schema])
            ),
            array(),
            $this->getNormalizedTimestamp()
        );
    }

    /**
     * @param Ingresse\Store\Order\Order $order
     * @param string                     $action
     */
    public function trackOrderAction(Order $order, $action)
    {
        $this->trackUnstructuredEvent(
            $this->config['ingresseOrderSchema'],
            $order,
            $this->config['ingresseOrderContext'],
            $action
        );
    }

    /**
     * @param Ingresse\Domain\Entity\Sale $sale
     * @param string                      $action
     */
    public function trackSaleAction(Sale $sale, $action)
    {
        $this->trackUnstructuredEvent(
            $this->config['ingresseSaleSchema'],
            $sale,
            $this->config['ingresseSaleContext'],
            $action
        );
    }

    /**
     * @param Ingresse\Domain\Entity\User $user
     * @param string                      $action
     */
    public function trackUserAction(User $user, $action)
    {
        $this->trackUnstructuredEvent(
            $this->config['ingresseAccountSchema'],
            $user,
            $this->config['ingresseUserContext'],
            $action
        );
    }

    public function flush()
    {
        if ($this->tracker) {
            $this->tracker->flushEmitters();
        }
        return;
    }

    public function getNormalizedTimestamp()
    {
        return time()*1000;
    }

    public function __destruct()
    {
        $this->flush();
    }
}
