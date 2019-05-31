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
     * @var boolean;
     */
    private $logged;

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

        setupTracker($this->company_config);
    }

    /**
     * @param mixed  $order_transaction_id
     * @param mixed  $order_sale_id
     * @param mixed  $order_sale_status
     * @param mixed  $order_user_id
     * @param mixed  $order_user_ip
     * @param mixed  $order_company_id
     * @param mixed  $order_event_id
     * @param mixed  $order_event_date_id
     * @param mixed  $order_tickets
     * @param mixed  $order_total_price
     * @param mixed  $order_date
     * @param mixed  $order_days_until_event
     * @param mixed  $order_fraud_payload
     * @param mixed  $order_refund_reason
     * @param mixed  $order_refund_operator
     * @param mixed  $order_refund_cashier
     * @param mixed  $order_refund_date
     * @param mixed  $order
     * @param string $action
     */
    public function trackOrderAction(
        $order_transaction_id,
        $order_sale_id,
        $order_sale_status,
        $order_user_id,
        $order_user_ip,
        $order_company_id,
        $order_event_id,
        $order_event_date_id,
        $order_tickets,
        $order_total_price,
        $order_date,
        $order_days_until_event,
        $order_fraud_payload,
        $order_refund_reason,
        $order_refund_operator,
        $order_refund_cashier,
        $order_refund_date,
        $action
    ) {
        if(!$this->verifyTracker()){
            $this->setupTracker();
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['ingresseOrderSchema'],
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
                    "order_date"             => $order_date,
                    "order_days_until_event" => $order_days_until_event,
                    "order_fraud_payload"    => $order_fraud_payload,
                    "order_refund_reason"    => $order_refund_reason,
                    "order_refund_operator"  => $order_refund_operator,
                    "order_refund_cashier"   => $order_refund_cashier,
                    "order_refund_date"      => $order_refund_date
                ]
            ),
            array(
                "schema" => $this->default_config['ingresseOrderContext'],
                "data" => array(
                    "action" => $action
                )
            ),
            $this->getNormalizedTimestamp()
        );
    }

    /**
     * @param mixed  $sale_transaction_id
     * @param mixed  $sale_id
     * @param mixed  $sale_event_id
     * @param mixed  $sale_total
     * @param mixed  $sale_status
     * @param mixed  $sale_installments
     * @param mixed  $sale_payment_option
     * @param mixed  $sale_cc_first_six
     * @param mixed  $sale_cc_last_four
     * @param mixed  $sale_cc_holder_name
     * @param mixed  $sale_cc_holder_cpf
     * @param mixed  $sale_cc_billing_city
     * @param mixed  $sale_cc_billing_state
     * @param mixed  $sale_cc_billing_zip_code
     * @param mixed  $sale_creation_date
     * @param mixed  $sale_modification_date
     * @param string $action
     */
    public function trackSaleAction (
        $sale_transaction_id,
        $sale_id,
        $sale_event_id,
        $sale_total,
        $sale_status,
        $sale_installments,
        $sale_payment_option,
        $sale_cc_first_six,
        $sale_cc_last_four,
        $sale_cc_holder_name,
        $sale_cc_holder_cpf,
        $sale_cc_billing_city,
        $sale_cc_billing_state,
        $sale_cc_billing_zip_code,
        $sale_creation_date,
        $sale_modification_date,
        $action
    ) {
        if(!$this->verifyTracker()){
            throw new TrackerException(9002);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['ingresseSaleSchema'],
                "data" => [
                    "sale_transaction_id"      => $sale_transaction_id, 
                    "sale_id"                  => $sale_id,            
                    "sale_event_id"            => $sale_event_id,       
                    "sale_total"               => $sale_total,         
                    "sale_status"              => $sale_status,        
                    "sale_installments"        => $sale_installments,  
                    "sale_payment_option"      => $sale_payment_option,
                    "sale_cc_first_six"        => $sale_cc_first_six,
                    "sale_cc_last_four"        => $sale_cc_last_four,
                    "sale_cc_holder_name"      => $sale_cc_holder_name,
                    "sale_cc_holder_cpf"       => $sale_cc_holder_cpf,
                    "sale_cc_billing_city"     => $sale_cc_billing_city,
                    "sale_cc_billing_state"    => $sale_cc_billing_state,
                    "sale_cc_billing_zip_code" => $sale_cc_billing_zip_code,
                    "sale_creation_date"       => $sale_creation_date,
                    "sale_modification_date"   => $sale_modification_date
                ]
            ),
            array(
                "schema" => $this->default_config['ingresseSaleContext'],
                "data" => array(
                    "action" => $action
                )
            ),
            $this->getNormalizedTimestamp()
        );
    }

    /**
     * @param mixed  $user_id
     * @param mixed  $user_company_id
     * @param mixed  $user_email
     * @param mixed  $user_name
     * @param mixed  $user_document
     * @param mixed  $user_ddi
     * @param mixed  $user_phone
     * @param mixed  $user_state
     * @param mixed  $user_city
     * @param mixed  $user_zip
     * @param mixed  $user_creation_date
     * @param string $action
     */
    public function trackUserAction(
        $user_id,
        $user_company_id,
        $user_email,
        $user_name,
        $user_document,
        $user_ddi,
        $user_phone,
        $user_state,
        $user_city,
        $user_zip,
        $user_creation_date,
        $action
    ) {
        if(!$this->verifyTracker()){
            throw new TrackerException(9002);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['ingresseUserSchema'],
                "data" => [
                    "user_id"            => $user_id, 
                    "user_company_id"    => $user_company_id,            
                    "user_email"         => $user_email, 
                    "user_name"          => $user_name, 
                    "user_document"      => $user_document, 
                    "user_ddi"           => $user_ddi, 
                    "user_phone"         => $user_phone, 
                    "user_state"         => $user_state, 
                    "user_city"          => $user_city, 
                    "user_zip"           => $user_zip, 
                    "user_creation_date" => $user_creation_date
                ]
            ),
            array(
                "schema" => $this->default_config['ingresseUserContext'],
                "data" => array(
                    "action" => $action
                )
            ),
            $this->getNormalizedTimestamp()
        );
    }

    /**
     * @param mixed  $transfer_id
     * @param mixed  $transfer_sale_id
     * @param mixed  $transfer_sale_ticket_id
     * @param mixed  $transfer_sender_id
     * @param mixed  $transfer_receiver_id
     * @param mixed  $transfer_event_id
     * @param mixed  $transfer_event_date_id
     * @param mixed  $transfer_status
     * @param mixed  $transfer_date
     * @param string $action
     */
    public function trackTicketTransfer(
        $transfer_id,
        $transfer_sale_id,
        $transfer_sale_ticket_id,
        $transfer_sender_id,
        $transfer_receiver_id,
        $transfer_event_id,
        $transfer_event_date_id,
        $transfer_status,
        $transfer_date,
        $action
    ) {
        if(!$this->verifyTracker()){
            throw new TrackerException(9002);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['ingresseTransferSchema'],
                "data" => [
                    "transfer_id"             => $transfer_id,
                    "transfer_sale_id"        => $transfer_sale_id,
                    "transfer_sale_ticket_id" => $transfer_sale_ticket_id,
                    "transfer_sender_id"      => $transfer_sender_id,
                    "transfer_receiver_id"    => $transfer_receiver_id,
                    "transfer_event_id"       => $transfer_event_id,
                    "transfer_event_date_id"  => $transfer_event_date_id,
                    "transfer_status"         => $transfer_status,
                    "transfer_date"           => $transfer_date
                ]
            ),
            array(
                "schema" => $this->default_config['ingresseTransferContext'],
                "data" => array(
                    "action" => $action
                )
            ),
            $this->getNormalizedTimestamp()
        );
    }

    /**
     * @param mixed  $auth_user_id
     * @param mixed  $auth_user_email
     * @param mixed  $auth_company_id
     * @param mixed  $auth_company_name
     * @param string $action
     */
    public function trackUserAuthentication(
        $auth_user_id,
        $auth_user_email,
        $auth_company_id,
        $auth_company_name,
        $action
    ) {
        if(!$this->verifyTracker()){
            throw new TrackerException(9002);
        }

        if($action != "user_login" && $action != "user_logout"){
            throw new TrackerException(9002); 
        }

        if ($action = "user_login") {
            $result = $this->setActiveUser($auth_user_id);
        } else {
            $result = $this->unsetActiveUser();
        }

        if(!$result) {
            return;
        }
        
        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['ingresseAuthSchema'],
                "data" => [
                    "auth_user_id"      => $auth_user_id,
                    "auth_user_email"   => $auth_user_email,
                    "auth_company_id"   => $auth_company_id,
                    "auth_company_name" => $auth_company_name
                ]
            ),
            array(
                "schema" => $this->default_config['ingresseAuthContext'],
                "data" => array(
                    "action" => $action
                )
            ),
            $this->getNormalizedTimestamp()
        );
    }

    /**
     * @param mixed  $user
     * @param string $action
     */
    public function trackPasswordRecovery($userData, $action)
    {
        if(!$this->verifyTracker()){
            throw new TrackerException(9002);
        }

        $this->tracker->trackUnstructEvent(
            array(
                "schema" => $this->default_config['ingressePassRecoverySchema'],
                "data" => [
                    "pass_recovery_email" => $userData,
                ]
            ),
            array(
                "schema" => $this->default_config['ingressePassRecoveryContext'],
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
        if(!$this->verifyTracker()){
            throw new TrackerException(9002);
        }
        $this->tracker->flushEmitters();
        return;
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
     * @param integer $userData
     */
    private function setActiveUser($userData)
    {
        if(!$this->verifyTracker()){
            throw new TrackerException(9002);
        } 

        if ($this->logged) {
            return false;
        }

        $this->logged = true;
        $this->subject->setUserId($userData);

        return true;
    }

    /**
     */
    private function unsetActiveUser()
    {
        if(!$this->verifyTracker()){
            throw new TrackerException(9002);
        }

        if (!$this->logged) {
            return false;
        }

        $this->logged = false;
        $this->subject->setUserId("");

        return true;
    }

    /**
     * @return int
     */
    private function getNormalizedTimestamp()
    {
        return time()*1000;
    }
}
