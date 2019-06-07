<?php

namespace Inspetor\Inspetor;

interface InspetorService
{
    /**
     * @param string $order_transaction_id
     * @param string $order_timestamp
     * @param string $order_sale_id
     * @param string $order_sale_status
     * @param string $order_user_id
     * @param string $order_user_ip
     * @param string $order_company_id
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
        $order_sale_id,
        $order_sale_status,
        $order_user_id,
        $order_user_ip,
        $order_company_id,
        $order_event_id,
        $order_event_date_id,
        $order_tickets,
        $order_total_price,
        $order_refund_reason,
        $order_refund_operator,
        $order_refund_cashier,
        $order_refund_date,
        $action
    );

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
        $transaction_create_timestamp,
        $action
    );

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
        $account_name,
        $account_document,
        $account_credit_card_info,
        $account_phone,
        $account_address,
        $account_billing_address,
        $account_create_timestamp,
        $action
    );

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
        $transfer_create_timestamp,
        $action
    );
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
        $auth_user_email,
        $auth_company_id,
        $auth_company_name,
        $action
    );

    /**
     * @param string pass_recovery_email
     * @param string pass_recovery_timestamp
     * @param string $action
     */
    public function trackPasswordRecovery(
        $pass_recovery_email,
        $pass_recovery_timestamp,
        $action
    );
}
