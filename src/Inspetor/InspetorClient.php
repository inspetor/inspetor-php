<?php

namespace Inspetor\Inspetor;

use Inspetor\Inspetor\Exception\TrackerException;
use JsonSerializable;
use Snowplow\Tracker\Tracker;
use Snowplow\Tracker\Subject;
use Snowplow\Tracker\Emitters\SyncEmitter;

class InspetorClient implements InspetorService
{
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
     * @param string $order_transaction_id
     * @param string $order_timestamp
     * @param string $order_sale_id
     * @param string $order_sale_status
     * @param string $order_user_id
     * @param string $order_user_ip
     * @param string $order_event_id
     * @param string $order_event_date_id
     * @param string $order_tickets
     * @param string $order_total_price
     * @param string $order_refund_reason
     * @param string $order_refund_operator
     * @param string $order_refund_cashier
     * @param string $order_refund_date
     * @param string $action
     */
    public function trackOrderAction(
        $order_transaction_id,
        $order_timestamp,
        $order_sale_id = null,
        $order_sale_status = null,
        $order_user_id = null,
        $order_user_ip = null,
        $order_event_id = null,
        $order_event_date_id = null,
        $order_tickets = null,
        $order_total_price = null,
        $order_refund_reason = null,
        $order_refund_operator = null,
        $order_refund_cashier = null,
        $order_refund_date = null,
        $action
    ) {
        $this->verifyTracker();

        $valid_actions = [
            "new_order",
            "order_refund"
        ];

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9004);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['inspetorOrderSchema'],
                "data" => [
                    "order_transaction_id"   => $order_transaction_id,
                    "order_sale_id"          => $order_sale_id,
                    "order_sale_status"      => $order_sale_status,
                    "order_user_id"          => $order_user_id,
                    "order_user_ip"          => $order_user_ip,
                    "order_company_id"       => $order_company_id,
                    "order_event_id"         => $order_event_id,
                    "order_event_date_id"    => $order_event_date_id,
                    "order_tickets"          => $order_tickets,
                    "order_total_price"      => $order_total_price,
                    "order_timestamp"        => $order_timestamp,
                    "order_refund_reason"    => $order_refund_reason,
                    "order_refund_operator"  => $order_refund_operator,
                    "order_refund_cashier"   => $order_refund_cashier,
                    "order_refund_date"      => $order_refund_date,
                ]
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
     * @param string $transaction_id
     * @param string $transaction_account_id
     * @param string $transaction_event_id
     * @param string $transaction_event_date_id
     * @param string $transaction_value
     * @param string $transaction_status
     * @param string $transaction_installments
     * @param string $transaction_payment_method
     * @param array  $transaction_payment_info
     * @param array  $transaction_tickets_id
     * @param string $transaction_create_timestamp
     * @param string $transaction_update_timestamp
     * @param string $action
     */
    public function trackSaleAction (
        $transaction_id,
        $transaction_account_id,
        $transaction_event_id,
        $transaction_event_date_id,
        $transaction_value,
        $transaction_status,
        $transaction_installments,
        $transaction_payment_method,
        $transaction_payment_info,
        $transaction_tickets_id,
        $transaction_update_timestamp,
        $transaction_create_timestamp = null,
        $action
    ) {
        $this->verifyTracker();

        $valid_actions = [
            "transaction_payment",
            "transaction_cancelled",
            "transaction_declined",
            "transaction_refund"
        ];

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9005);
        }

        if ($transaction_payment_method == "credit_card") {
            $transaction_payment_info = $this->prepareCreditCardDataHashed($transaction_payment_info);
        } else {
            $transaction_payment_info = base64_encode($transaction_payment_info);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['inspetorSaleSchema'],
                "data" => [
                    "transaction_id"                  => $transaction_id,
                    "transaction_account_id"          => $transaction_account_id,
                    "transaction_event_id"            => $transaction_event_id,
                    "transaction_value"               => $transaction_value,
                    "transaction_status"              => $transaction_status,
                    "transaction_installments"        => $transaction_installments,
                    "transaction_payment_method"      => $transaction_payment_method,
                    "transaction_payment_info_hash"   => $transaction_payment_info,
                    "transaction_tickets_id"          => $transaction_tickets_id,
                    "transaction_create_timestamp"    => $transaction_create_timestamp,
                    "transaction_update_timestamp"    => $transaction_update_timestamp
                ]
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
     * @param string $account_id
     * @param string $account_update_timestamp
     * @param string $account_company_id
     * @param string $account_email
     * @param string $account_name
     * @param string $account_document
     * @param string $account_credit_card_info
     * @param string $account_phone
     * @param string $account_address
     * @param string $account_billing_address
     * @param string $account_create_timestamp
     * @param string $action
     */
    public function trackAccountAction(
        $account_id,
        $account_update_timestamp,
        $account_company_id = null,
        $account_email,
        $account_name = null,
        $account_document = null,
        $account_credit_card_info = null,
        $account_phone = null,
        $account_address = null,
        $account_billing_address = null,
        $account_create_timestamp = null,
        $action
    ) {
        $this->verifyTracker();

        $valid_actions = [
            "account_create",
            "account_update",
            "account_delete"
        ];

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9003);
        }

        if ($account_address) {
            $account_address = $this->prepareAddressDataHashed($account_address);
        }

        if ($account_billing_address) {
            $account_billing_address = $this->prepareAddressDataHashed($account_billing_addresss);
        }

        if ($account_credit_card_info) {
            $account_credit_card_info = $this->prepareCreditCardDataHashed($account_credit_card_info);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['ingresseAccountSchema'],
                "data" => [
                    "account_id"                    => $account_id,
                    "account_company_id"            => $account_company_id,
                    "account_email_hash"            => base64_encode($account_email),
                    "account_name_hash"             => base64_encode($account_name),
                    "account_document_hash"         => base64_encode($account_document),
                    "account_phone_number_hash"     => base64_encode($account_phone),
                    "account_address_hash"          => $account_address,
                    "account_billing_address_hash"  => $account_billing_address,
                    "account_credit_card_info_hash" => $account_credit_card_info,
                    "account_create_timestamp"      => $account_create_timestamp,
                    "account_update_timestamp"      => $account_update_timestamp,
                ]
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
     * @param string $transfer_id
     * @param string $transfer_sale_id
     * @param string $transfer_sale_ticket_id
     * @param string $transfer_sender_id
     * @param string $transfer_receiver_email
     * @param string $transfer_event_id
     * @param string $transfer_event_date_id
     * @param string $transfer_status
     * @param string $transfer_update_timestamp
     * @param string $transfer_create_timestamp
     * @param string $action
     */
    public function trackTicketTransfer(
        $transfer_id,
        $transfer_transaction_id,
        $transfer_sale_ticket_id,
        $transfer_sender_id,
        $transfer_receiver_email,
        $transfer_event_id,
        $transfer_event_date_id,
        $transfer_status,
        $transfer_update_timestamp,
        $transfer_create_timestamp = null,
        $action
    ) {
        $this->verifyTracker();

        $valid_actions = [
            "transfer_create",
            "transfer_update"
        ];

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9006);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['inspetorTransferSchema'],
                "data" => [
                    "transfer_id"                  => $transfer_id,
                    "transfer_sale_id"             => $transfer_sale_id,
                    "transfer_transaction_id"      => $transfer_transaction_id,
                    "transfer_sender_id"           => $transfer_sender_id,
                    "transfer_receiver_email_hash" => base64_encode($transfer_receiver_email),
                    "transfer_event_id"            => $transfer_event_id,
                    "transfer_event_date_id"       => $transfer_event_date_id,
                    "transfer_status"              => $transfer_status,
                    "transfer_timestamp"           => $transfer_timestamp,
                    "transfer_update_timestamp"    => $transfer_update_timestamp,
                    "transfer_create_timestamp"    => $transfer_create_timestamp
                ]
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
     * @param string $auth_user_id
     * @param string $auth_timestamp
     * @param string $auth_user_email
     * @param string $auth_company_id
     * @param string $auth_company_name
     * @param string $action
     */
    public function trackUserAuthentication(
        $auth_user_id,
        $auth_timestamp,
        $auth_user_email = null,
        $auth_company_id = null,
        $auth_company_name = null,
        $action
    ) {
        $this->verifyTracker();

        $valid_actions = [
            "user_login",
            "user_logout"
        ];

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9002);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['inspetorAuthSchema'],
                "data" => [
                    "auth_user_id"         => $auth_user_id,
                    "auth_user_email_hash" => base64_encode($auth_user_email),
                    "auth_company_id"      => $auth_company_id,
                    "auth_company_name"    => $auth_company_name,
                    "auth_timestamp"       => $auth_timestamp
                ]
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
     * @param string pass_recovery_email
     * @param string pass_recovery_timestamp
     * @param string $action
     */
    public function trackPasswordRecovery(
        $pass_recovery_email,
        $pass_recovery_timestamp,
        $action
    ) {
        $this->verifyTracker();

        $valid_actions = [
            "password_reset",
            "password_recovery"
        ];

        if (!in_array($action, $valid_actions)) {
            throw new TrackerException(9007);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['inspetorPassRecoverySchema'],
                "data" => [
                    "pass_recovery_email_hash" => base64_encode($pass_recovery_email),
                    "pass_recovery_timestamp"  => $pass_recovery_timestamp
                ]
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

    /**
     * @param array
     * @return array
     */
    private function prepareAddressDataHashed($address) {
        return [
            "street_address_hash" => base64_encode($address["street_address"]),
            "city_hash"           => base64_encode($address["city"]),
            "state_hash"          => base64_encode($address["state"]),
            "zip_hash"            => base64_encode($address["zip"])
        ];
    }

    /**
     * @param array
     * @return array
     */
    private function prepareCreditCardDataHashed($creditcard) {
        return [
            "cc_first_six_hash"   => base64_encode($creditcard["cc_first_six"]),
            "cc_last_four_hash"   => base64_encode($creditcard["cc_last_four"]),
            "cc_holder_name_hash" => base64_encode($creditcard["cc_holder_name"]),
            "cc_holder_cpf_hash"  => base64_encode($creditcard["cc_holder_cpf"])
        ];
    }
}
