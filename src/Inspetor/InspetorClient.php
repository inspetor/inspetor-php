<?php

namespace Inspetor\Inspetor;

use Inspetor\Inspetor\Exception\TrackerException;
use JsonSerializable;
use Snowplow\Tracker\Tracker;
use Snowplow\Tracker\Subject;
use Snowplow\Tracker\Emitters\SyncEmitter;

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
        if(!$this->verifyTracker()) {
            $this->setupTracker($config);
        }
    }

    /** 
     * @param array  $config Config from main application
     * @return array
     */
    private function setupTracker($config) {
        $company_config = $this->setupConfig($config);

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
     * @throws TrackerException
     */
    private function setupConfig($config) {
        $this->default_config = include('config.php');
        $this->default_config = $this->default_config['inspetor_config'];

        if (!($config['trackerName']) || !($config['appId'])) {
            throw new TrackerException(9001);
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
     * @return boolean
     */
    private function verifyTracker() {
        if ($this->tracker) {
            return true;
        }

        return false;
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
     * @param array $userData
     */
    private function setActiveUser(string $userData)
    {
        if(!verifyTracker()){
            throw new TrackerException(9002);
        }

        $this->subject->setUserId($userData);
    }

    /**
     */
    private function unsetActiveUser()
    {
        if(!verifyTracker()){
            throw new TrackerException(9002);
        }

        $this->subject->setUserId("");
    }

    /**
     * @param object $order
     * @param string $action
     */
    private function trackOrderAction($order, $action)
    {
        if(!verifyTracker()){
            throw new TrackerException(9002);
        }

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
    private function trackSaleAction($sale, $action)
    {
        if(!verifyTracker()){
            throw new TrackerException(9002);
        }

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
    private function trackUserAction($user, $action)
    {
        if(!verifyTracker()){
            throw new TrackerException(9002);
        }

        $this->trackUnstructuredEvent(
            $this->default_config['ingresseAccountSchema'],
            $user,
            $this->default_config['ingresseUserContext'],
            $action
        );
    }

    /**
     * @param object $user
     * @param string $action
     */
    private function trackTicketTransfer($transferData, $action)
    {
        if(!verifyTracker()){
            throw new TrackerException(9002);
        }

        $this->trackUnstructuredEvent(
            $this->default_config['ingresseTransferSchema'],
            $user,
            $this->default_config['ingresseTransferContext'],
            $action
        );
    }


    /**
     * @param object $user
     * @param string $action
     */
    private function trackUserAuthentication($user, $action)
    {
        if(!verifyTracker()){
            throw new TrackerException(9002);
        }

        $this->trackUnstructuredEvent(
            $this->default_config['ingresseAuthSchema'],
            $user,
            $this->default_config['ingresseAuthContext'],
            $action
        );

        if ($action = "user_login") {
            $this->setActiveUser($user);
        } else {
            $this->unsetActiveUser();
        }
    }

    private function flush()
    {
        if(!verifyTracker()){
            throw new TrackerException(9002);
        }
        $this->tracker->flushEmitters();
        return;
    }

    private function getNormalizedTimestamp()
    {
        return time()*1000;
    }

    private function __destruct()
    {
        $this->flush();
    }
}
