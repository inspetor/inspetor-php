<?php

namespace Inspetor;

use Inspetor\SnowplowManager;

use Inspetor\Exception\TrackerException;

use Inspetor\Model\InspetorAccount;
use Inspetor\Model\InspetorAuth;
use Inspetor\Model\InspetorEvent;
use Inspetor\Model\InspetorPassRecovery;
use Inspetor\Model\InspetorSale;
use Inspetor\Model\InspetorTransfer;

use JsonSerializable;

class InspetorResource implements InspetorResourceService {
    /**
     * @var array
     */
    private $default_config;

    /**
     * @var array
     */
    private $company_config;

    /**
     * @var Snowplow\Tracker\Tracker;
     */
    private $tracker;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->company_config = $config;
        $this->default_config = include('config.php');
        $this->default_config = $this->default_config['inspetor_config'];

        $snowplow_manager = new SnowplowManager($config);
        $this->tracker = $snowplow_manager->getTracker();
    }

    /**
     * @return boolean
     */
    public function verifyTracker() {
        if ($this->tracker) {
            return true;
        }

        $snowplow_manager = new SnowplowManager($this->config);
        $this->tracker = $snowplow_manager->getTracker();
    }

    /**
     * trackSaleAction
     *
     * @param Inspetor\Model\InspetorSale $data
     * @param string $action
     * @return void
     */
    public function trackSaleAction(InspetorSale $data, string $action) {

        $valid_actions = [
            InspetorSale::SALE_CREATE_ACTION,
            InspetorSale::SALE_UPDATE_STATUS_ACTION
        ];

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9005);
        }

        if ($action == InspetorSale::SALE_CREATE_ACTION) {
            $data->isValid();
        }

        $data->isValidUpdate();

        $this->trackUnstructuredEvent(
            $this->default_config['inspetorSaleSchema'],
            $data,
            $this->default_config['inspetorContext'],
            $action
        );
    }

    /**
     * trackAccountAction
     *
     * @param Inspetor\Model\InspetorAccount $data
     * @param string $action
     * @return void
     */
    public function trackAccountAction(InspetorAccount $data, string $action) {

        $valid_actions = [
            InspetorAccount::ACCOUNT_CREATE_ACTION,
            InspetorAccount::ACCOUNT_UPDATE_ACTION,
            InspetorAccount::ACCOUNT_DELETE_ACTION
        ];

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9003);
        }

        if ($action == InspetorAccount::ACCOUNT_CREATE_ACTION) {
            $data->isValid();
        }

        $data->isValidUpdate();

        $this->trackUnstructuredEvent(
            $this->default_config['inspetorAccountSchema'],
            $data,
            $this->default_config['inspetorContext'],
            $action
        );
    }

    /**
     * trackEventAction
     *
     * @param Inspetor\Model\InspetorEvent $data
     * @param string $action
     * @return void
     */
    public function trackEventAction(InspetorEvent $data, string $action) {

        $valid_actions = [
            InspetorEvent::EVENT_CREATE_ACTION,
            InspetorEvent::EVENT_UPDATE_ACTION,
            InspetorEvent::EVENT_DELETE_ACTION
        ];

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9008);
        }

        if ($action == InspetorEvent::EVENT_CREATE_ACTION) {
            $data->isValid();
        }

        $data->isValidUpdate();

        $this->trackUnstructuredEvent(
            $this->default_config['inspetorEventSchema'],
            $data,
            $this->default_config['inspetorContext'],
            $action
        );
    }


    /**
     * trackItemTransferAction
     *
     * @param Inspetor\Model\InspetorTransfer $data
     * @param string $action
     * @return void
     */
    public function trackItemTransferAction(InspetorTransfer $data, string $action) {

        $valid_actions = [
            InspetorTransfer::TRANSFER_CREATE_ACTION,
            InspetorTransfer::TRANSFER_UPDATE_STATUS_ACTION
        ];

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9006);
        }

        if ($action == InspetorTransfer::TRANSFER_CREATE_ACTION) {
            $data->isValid();
        }

        $data->isValidUpdate();

        $this->trackUnstructuredEvent(
            $this->default_config['inspetorTransferSchema'],
            $data,
            $this->default_config['inspetorContext'],
            $action
        );
    }

    /**
     * trackAccountAuthAction
     *
     * @param Inspetor\Model\InspetorAuth $data
     * @param string $action
     * @return void
     */
    public function trackAccountAuthAction(InspetorAuth $data, string $action) {

        $valid_actions = [
            InspetorAuth::ACCOUNT_LOGIN_ACTION,
            InspetorAuth::ACCOUNT_LOGOUT_ACTION
        ];

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9002);
        }

        $data->isValid();

        $this->trackUnstructuredEvent(
            $this->default_config['inspetorAuthSchema'],
            $data,
            $this->default_config['inspetorContext'],
            $action
        );
    }

    /**
     * trackPasswordRecoveryAction
     *
     * @param Inspetor\Model\InspetorPassRecovery $data
     * @param string $action
     * @return void
     */
    public function trackPasswordRecoveryAction(InspetorPassRecovery $data, string $action) {

        $valid_actions = [
            InspetorPassRecovery::PASSWORD_RESET_ACTION,
            InspetorPassRecovery::PASSWORD_RECOVERY_ACTION
        ];


        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9007);
        }

        $data->isValid();

        $this->trackUnstructuredEvent(
            $this->default_config['inspetorPassRecoverySchema'],
            $data,
            $this->default_config['inspetorContext'],
            $action
        );
    }

    public function __destruct()
    {
        $this->flush();
    }

    public function flush()
    {
        $this->verifyTracker();
        $this->tracker->flushEmitters();
        return;
    }

    /**
     * @return int
     */
    private function getNormalizedTimestamp()
    {
        return time()*1000;
    }

    /**
     * @param string $schema  Iglu identifier of custom event schema
     * @param object $data    Should implement JsonSerializable
     * @param string $context Iglu identifier of custom event context
     * @param string $action  Define context function
     */
    private function trackUnstructuredEvent($schema, $data, $context, $action)
    {
        $this->verifyTracker();

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
     * Report non serializable data
     *
     * @param string $schema Iglu identifier of custom event schema
     */
    private function reportNonserializableCall($schema)
    {
        $this->verifyTracker();

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->config['ingresseSerializationError'],
                "data" => (['intendedSchemaId' => $schema])
            ),
            array(),
            $this->getNormalizedTimestamp()
        );
    }
}
