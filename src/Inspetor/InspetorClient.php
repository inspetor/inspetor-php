<?php

namespace Inspetor\Inspetor;

use Inspetor\Inspetor\Exception\TrackerException;

use Inspetor\Inspetor\Model\Account;
use Inspetor\Inspetor\Model\Auth;
use Inspetor\Inspetor\Model\Event;
use Inspetor\Inspetor\Model\Item;
use Inspetor\Inspetor\Model\PassRecovery;
use Inspetor\Inspetor\Model\Sale;
use Inspetor\Inspetor\Model\Transfer;

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
     * @param Sale $sale_data
     * @param string $action
     */
    public function trackSaleAction (Sale $sale_data, $action) {
        $this->verifyTracker();

        $valid_actions = [
            "sale_create",
            "sale_update_status"
        ];

        $sale_data->isValid();

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9005);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['inspetorSaleSchema'],
                "data" => $sale_data->jsonSerialize()
            ),
            array(
                "schema" => $this->default_config['inspetorContext'],
                "data" => array(
                    "action" => $action
                )
            ),
            $this->getNormalizedTimestamp()
        );
    }

    /**
     * @param Account $account_data
     * @param string $action
     */
    public function trackAccountAction(Account $account_data, $action) {
        $this->verifyTracker();

        $valid_actions = [
            "account_create",
            "account_update",
            "account_delete"
        ];

        $account_data->isValid();

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9003);
        }
        
        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['ingresseAccountSchema'],
                "data" => $account_data->jsonSerialize()
            ),
            array(
                "schema" => $this->default_config['inspetorContext'],
                "data" => array(
                    "action" => $action
                )
            ),
            $this->getNormalizedTimestamp()
        );
    }

    /**
     * @param Transfer $transfer_data
     * @param string $action
     */
    public function trackTicketTransfer(Transfer $transfer_data, $action) {
        $this->verifyTracker();

        $valid_actions = [
            "transfer_create",
            "transfer_update_status"
        ];

        $transfer_data->isValid();

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9006);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['inspetorTransferSchema'],
                "data" => $transfer_data->jsonSeialize()
            ),
            array(
                "schema" => $this->default_config['inspetorContext'],
                "data" => array(
                    "action" => $action
                )
            ),
            $this->getNormalizedTimestamp()
        );
    }

    /**
     * @param Auth $auth_data
     * @param string $action
     */
    public function trackUserAuthentication(Auth $auth_data, $action) {
        $this->verifyTracker();

        $valid_actions = [
            "account_login",
            "account_logout"
        ];

        $auth_data->isValid();

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9002);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['inspetorAuthSchema'],
                "data" => $auth_data->jsonSerialize()
            ),
            array(
                "schema" => $this->default_config['inspetorContext'],
                "data" => array(
                    "action" => $action
                )
            ),
            $this->getNormalizedTimestamp()
        );
    }

    /**
     * @param PassRecovery $pass_recovery_data
     * @param string $action
     */
    public function trackPasswordRecovery(PassRecovery $pass_recovery_data, $action) {
        $this->verifyTracker();

        $valid_actions = [
            "password_reset",
            "password_recovery"
        ];

        $pass_recovery_data->isValid();

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9007);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['inspetorPassRecoverySchema'],
                "data" => $pass_recovery_data->jsonSerialize()
            ),
            array(
                "schema" => $this->default_config['inspetorContext'],
                "data" => array(
                    "action" => $action
                )
            ),
            $this->getNormalizedTimestamp()
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
}
