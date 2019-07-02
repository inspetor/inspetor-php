<?php
/**
 * InspetorApi
 * PHP version 5
 *
 * @category Class
 * @package  Inspetor\
 * @author   Inspetor Dev Team
 */

/**
 * Inspetor Antifraud
 *
 * This is an antifraud product developed to analyzes transactions and identify frauds using trackers and analytics tools. This file must explain every request and parametes that a library must provide to a client.
 *
 * OpenAPI spec version: 1.0.6
 * Contact: theo@useinspetor.com
 */

namespace Inspetor;

use Inspetor\Model\Account;
use Inspetor\Model\Auth;
use Inspetor\Model\Event;
use Inspetor\Model\PassRecovery;
use Inspetor\Model\Sale;
use Inspetor\Model\Transfer;

/**
 * InspetorApi Class Doc Comment
 *
 * @category Class
 * @package  Inspetor
 * @author   Inspetor Dev Team
 */
interface InspetorService {
    /**
     * Operation getInspetorAccount
     *
     * @return \Inspetor\Model\Account
     */
    public function getInspetorAccount();
    /**
     * Operation getInspetorAuth
     *
     * @return \Inspetor\Model\Auth
     */
    public function getInspetorAuth();
    /**
     * Operation getInspetorCategory
     *
     * @return \Inspetor\Model\Category
     */
    public function getInspetorCategory();
    /**
     * Operation getInspetorCreditCard
     *
     * @return \Inspetor\Model\CreditCard
     */
    public function getInspetorCreditCard();
    /**
     * Operation getInspetorEvent
     *
     * @return \Inspetor\Model\Event
     */
    public function getInspetorEvent();
    /**
     * Operation getInspetorItem
     *
     * @return \Inspetor\Model\Item
     */
    public function getInspetorItem();
    /**
     * Operation getInspetorPassRecovery
     *
     * @return \Inspetor\Model\PassRecovery
     */
    public function getInspetorPassRecovery();
    /**
     * Operation getInspetorPayment
     *
     * @return \Inspetor\Model\Payment
     */
    public function getInspetorPayment();
    /**
     * Operation getInspetorTransfer
     *
     * @return \Inspetor\Model\Transfer
     */
    public function getInspetorTransfer();
    /**
     * Operation trackAccountCreation
     *
     * Send account creation data to Inspetor
     *
     * @param  \Inspetor\Model\Account $account account (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\AccountException
     * @return void
     */
    public function trackAccountCreation(Account $account);
    /**
     * Operation trackAccountDeletion
     *
     * Send account deletion data to Inspetor
     *
     * @param  \Inspetor\Model\Account $account account (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\AccountException
     * @return void
     */
    public function trackAccountDeletion(Account $account);
    /**
     * Operation trackAccountUpdate
     *
     * Send account update data to Inspetor
     *
     * @param  \Inspetor\Model\Account $account account (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\AccountException
     * @return void
     */
    public function trackAccountUpdate(Account $account);
    /**
     * Operation trackEventCreation
     *
     * Send event creation data to Inspetor
     *
     * @param  \Inspetor\Model\Event $event event (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\EventException
     * @return void
     */
    public function trackEventCreation(Event $event);
    /**
     * Operation trackEventDeletion
     *
     * Send event deletion data to Inspetor
     *
     * @param  \Inspetor\Model\Event $event event (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\EventException
     * @return void
     */
    public function trackEventDeletion(Event $event);
    /**
     * Operation trackEventUpdate
     *
     * Send event update data to Inspetor
     *
     * @param  \Inspetor\Model\Event $event event (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\EventException
     * @return void
     */
    public function trackEventUpdate(Event $event);
    /**
     * Operation trackItemTransferCreation
     *
     * Send item transfer creation data to Inspetor
     *
     * @param  \Inspetor\Model\Transfer $transfer transfer (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\TransferException
     * @return void
     */
    public function trackItemTransferCreation(Transfer $transfer);
    /**
     * Operation trackItemTransferUpdate
     *
     * Send item transfer update data to Inspetor
     *
     * @param  \Inspetor\Model\Transfer $transfer transfer (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\TransferException
     * @return void
     */
    public function trackItemTransferUpdate(Transfer $transfer);
    /**
     * Operation trackLogin
     *
     * Send account login data to Inspetor
     *
     * @param  \Inspetor\Model\Auth $auth auth (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\AuthException
     * @return void
     */
    public function trackLogin(Auth $auth);
    /**
     * Operation trackLogout
     *
     * Send account logout data to Inspetor
     *
     * @param  \Inspetor\Model\Auth $auth auth (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\AuthException
     * @return void
     */
    public function trackLogout(Auth $auth);
    /**
     * Operation trackPasswordRecovery
     *
     * Send password recovery data to Inspetor
     *
     * @param  \Inspetor\Model\PassRecovery $pass_recovery pass_recovery (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\PassRecoveryException
     * @return void
     */
    public function trackPasswordRecovery(PassRecovery $pass_recovery);
    /**
     * Operation trackPasswordReset
     *
     * Send password reset data to Inspetor
     *
     * @param  \Inspetor\Model\PassRecovery $pass_recovery pass_recovery (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\PassRecoveryException
     * @return void
     */
    public function trackPasswordReset(PassRecovery $pass_recovery);
    /**
     * Operation trackSaleCreation
     *
     * Send sale creation data to Inspetor
     *
     * @param  \Inspetor\Model\Sale $sale sale (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\SaleException
     * @return void
     */
    public function trackSaleCreation(Sale $sale);
    /**
     * Operation trackSaleDeletion
     *
     * Send sale deletion data to Inspetor
     *
     * @param  \Inspetor\Model\Sale $sale sale (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\SaleException
     * @return void
     */
    public function trackSaleDeletion(Sale $sale);
    /**
     * Operation trackSaleUpdate
     *
     * Send sale update data to Inspetor
     *
     * @param  \Inspetor\Model\Sale $sale sale (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\SaleException
     * @return void
     */
    public function trackSaleUpdate(Sale $sale);
}
