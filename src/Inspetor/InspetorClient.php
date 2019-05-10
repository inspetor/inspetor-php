<?php

namespace Inspetor\Inspetor;

use Snowplow\Tracker\Tracker;
use Snowplow\Tracker\Subject;
use Snowplow\Tracker\Emitters\SyncEmitter;
use JsonSerializable;

class InspetorClient
{
    /**
     * @var array
     */
    private $default_config;

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
        $company_config = $this->setup($config);

        $this->emitter = new SyncEmitter(
            $company_config['collectorHost'],
            $company_config['protocol'],
            $company_config['emitMethod'],
            $company_config['bufferSize'],
            $company_config['debugMode']
        );
        $this->subject = new Subject();
        $this->tracker = new Tracker(
            $this->emitter,
            $this->subject,
            $company_config['trackerName'],
            $company_config['appId'],
            $company_config['encode64']
        );
    }
    
    /** 
     * @param array  $config Config from main application
     * @return array
     */
    private function setup($config) {
        $this->default_config = include('config.php');
        $this->default_config = $this->default_config['inspetor_config'];

        if (!($config['trackerName']) || !($config['appId'])) {
            throw new Exception('\'trackerName\' and \'appId\' are required fields.');
        }

        $keys = ['collectorHost', 'protocol', 'emitMethod', 'bufferSize', 'debugMode', 'encode64'];
        foreach ($keys as $item) {
            if(!array_key_exists($item, $config)) { 
                $config = $config + array($item => $this->default_config[$item]);
            } else {
                $config[$item] = $config[$item] ?? $this->default_config[$item];
            }
        }

        return $config;
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
     * @param string $schema Iglu identifier of custom event schema
     */
    private function reportNonserializableCall($schema)
    {
        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['ingresseSerializationError'],
                "data" => (['intendedSchemaId' => $schema])
            ),
            array(),
            $this->getNormalizedTimestamp()
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
     * @param object $order
     * @param string $action
     */
    public function trackOrderAction($order, $action)
    {
        $this->trackUnstructuredEvent(
            $this->default_config['ingresseOrderSchema'],
            $order,
            $this->default_config['ingresseOrderContext'],
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
            $this->default_config['ingresseSaleSchema'],
            $sale,
            $this->default_config['ingresseSaleContext'],
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
            $this->default_config['ingresseAccountSchema'],
            $user,
            $this->default_config['ingresseUserContext'],
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
