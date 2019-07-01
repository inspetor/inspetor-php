<?php

namespace Inspetor;

use Inspetor\Exception\TrackerException;

use Inspetor\Model\Account;
use Inspetor\Model\Auth;
use Inspetor\Model\Event;
use Inspetor\Model\PassRecovery;
use Inspetor\Model\Sale;
use Inspetor\Model\Transfer;

use JsonSerializable;
use Snowplow\Tracker\Tracker;
use Snowplow\Tracker\Subject;
use Snowplow\Tracker\Emitters\SyncEmitter;

class InspetorClient implements InspetorService {
    /**
     * @var array
     */
    private $default_config;

    /**
     * @var array
     */
    private $company_config;

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
        $this->company_config = $config;
        $this->default_config = include('config.php');
        $this->default_config = $this->default_config['inspetor_config'];

        $this->verifyTracker();
    }

    /**
     * @return boolean
     */
    public function verifyTracker() {
        if ($this->tracker) {
            return true;
        }

        $this->setupTracker();
    }

    /**
     * trackSaleAction
     *
     * @param Inspetor\Model\Sale $data
     * @param string $action
     * @return void
     */
    public function trackSaleAction(Sale $data, string $action) {
        $this->verifyTracker();

        $valid_actions = [
            Sale::SALE_CREATE_ACTION,
            Sale::SALE_UPDATE_STATUS_ACTION
        ];

        $data->isValid();

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9005);
        }

        $this->trackUnstructEvent(
            $this->default_config['inspetorSaleSchema'],
            $data,
            $this->default_config['inspetorContext'],
            $action
        );
    }

    /**
     * trackAccountAction
     *
     * @param Inspetor\Model\Account $data
     * @param string $action
     * @return void
     */
    public function trackAccountAction(Account $data, string $action) {
        $this->verifyTracker();

        $valid_actions = [
            Account::ACCOUNT_CREATE_ACTION,
            Account::ACCOUNT_UPDATE_ACTION,
            Account::ACCOUNT_DELETE_ACTION
        ];

        $data->isValid();

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9003);
        }

        $this->trackUnstructEvent(
            $this->default_config['inspetorAccountSchema'],
            $data,
            $this->default_config['inspetorContext'],
            $action
        );
    }

    /**
     * trackEventAction
     *
     * @param Inspetor\Model\Event $data
     * @param string $action
     * @return void
     */
    public function trackEventAction(Event $data, string $action) {
        $this->verifyTracker();

        $valid_actions = [
            Event::CREATE_ACTION,
            Event::UPDATE_ACTION,
            Event::DELETE_ACTION
        ];

        $data->isValid();

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9008);
        }

        $this->trackUnstructEvent(
            $this->default_config['inspetorEventSchema'],
            $data,
            $this->default_config['inspetorContext'],
            $action
        );
    }


    /**
     * trackItemTransferAction
     *
     * @param Inspetor\Model\Transfer $data
     * @param string $action
     * @return void
     */
    public function trackItemTransferAction(Transfer $data, string $action) {
        $this->verifyTracker();

        $valid_actions = [
            Transfer::TRANSFER_CREATE_ACTION,
            Transfer::TRANSFER_UPDATE_STATUS_ACTION
        ];

        $data->isValid();

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9006);
        }

        $this->trackUnstructEvent(
            $this->default_config['inspetorTransferSchema'],
            $data,
            $this->default_config['inspetorContext'],
            $action
        );
    }

    /**
     * trackAccountAuthAction
     *
     * @param Inspetor\Model\Auth $data
     * @param string $action
     * @return void
     */
    public function trackAccountAuthAction(Auth $data, string $action) {
        $this->verifyTracker();

        $valid_actions = [
            Auth::ACCOUNT_LOGIN_ACTION,
            Auth::ACCOUNT_LOGOUT_ACTION
        ];

        $data->isValid();

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9002);
        }

        $this->trackUnstructEvent(
            $this->default_config['inspetorAuthSchema'],
            $data,
            $this->default_config['inspetorContext'],
            $action
        );
    }

    /**
     * trackPasswordRecoveryAction
     *
     * @param Inspetor\Model\PassRecovery $data
     * @param string $action
     * @return void
     */
    public function trackPasswordRecoveryAction(PassRecovery $data, string $action) {
        $this->verifyTracker();

        $valid_actions = [
            PassRecovery::PASSWORD_RESET_ACTION,
            PassRecovery::PASSWORD_RECOVERY_ACTION
        ];

        $data->isValid();

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9007);
        }

        $this->trackUnstructEvent(
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
     * @param array  $config Config from main application
     * @return array
     */
    private function setupTracker() {
        $company_config = $this->setupConfig($this->company_config);

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
        if (!($config['trackerName']) || !($config['appId'])) {
            throw new TrackerException(9001);
        }

        $keys = [
            'collectorHost',
            'protocol',
            'emitMethod',
            'bufferSize',
            'debugMode',
            'encode64'
        ];

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
}
