<?php

namespace Inspetor\Inspetor;

interface InspetorService
{
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
    );

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
    );

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
    );

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
    );

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
    );

    /**
     * @param mixed  $user
     * @param string $action
     */
    public function trackPasswordRecovery($userData, $action);
}
