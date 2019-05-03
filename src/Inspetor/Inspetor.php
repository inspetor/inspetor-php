<?php

namespace Inspetor;

use Snowplow\Tracker\Tracker;
use Snowplow\Tracker\Subject;
use Snowplow\Tracker\Emitters\SyncEmitter;
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
        $default_config = include('config.php');

        $this->config = $config;
        if (!($this->config['trackerName']) || !($this->config['appId'])) {
            throw new Exception('\'trackerName\' and \'appId\' are required fields.');
        }

        $this->emitter = new SyncEmitter(
            $this->config['collectorHost'] ?? $default_config['collectorHost'],
            $this->config['protocol'] ?? $default_config['protocol'],
            $this->config['emitMethod'] ?? $default_config['emitMethod'],
            $this->config['bufferSize'] ?? $default_config['bufferSize'],
            $this->config['debugMode'] ?? $default_config['debugMode']
        );
        $this->subject = new Subject();
        $this->tracker = new Tracker(
            $this->emitter,
            $this->subject,
            $this->config['trackerName'],
            $this->config['appId'],
            $this->config['encode64'] ?? $default_config['encode64']
        );
    }

    /**
     * @param array $userId
     */
    public function setActiveUser(string $userid)
    {
        $this->subject->setUserId($userId);
    }

    /**
     * @param array $userId
     */
    public function unsetActiveUser(string $userid)
    {
        $this->subject->setUserId("");
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
     * @param object $order
     * @param string $action
     */
    public function trackOrderAction($order, $action)
    {
        $this->trackUnstructuredEvent(
            $this->config['ingresseOrderSchema'],
            $order,
            $this->config['ingresseOrderContext'],
            $action
        );
    }

    /**
     * @param object $sale
     * @param string $action
     */
    public function trackSaleAction($sale, $action)
    {
        $this->trackUnstructuredEvent(
            $this->config['ingresseSaleSchema'],
            $sale,
            $this->config['ingresseSaleContext'],
            $action
        );
    }

    /**
     * @param object $user
     * @param string $action
     */
    public function trackUserAction($user, $action)
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
