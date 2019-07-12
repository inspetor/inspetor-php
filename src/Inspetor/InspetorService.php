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

use Inspetor\Model\InspetorAccount;
use Inspetor\Model\InspetorAuth;
use Inspetor\Model\InspetorEvent;
use Inspetor\Model\InspetorPassRecovery;
use Inspetor\Model\InspetorSale;
use Inspetor\Model\InspetorTransfer;

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
     * @return \Inspetor\Model\InspetorAccount
     */
    public function getInspetorAccount();

    /**
     * Operation getInspetorAddress
     *
     * @return \Inspetor\Model\InspetorAddress
     */
    public function getInspetorAddress();

    /**
     * Operation getInspetorAuth
     *
     * @return \Inspetor\Model\InspetorAuth
     */
    public function getInspetorAuth();

    /**
     * Operation getInspetorCategory
     *
     * @return \Inspetor\Model\InspetorCategory
     */
    public function getInspetorCategory();

    /**
     * Operation getInspetorCreditCard
     *
     * @return \Inspetor\Model\InspetorCreditCard
     */
    public function getInspetorCreditCard();

    /**
     * Operation getInspetorEvent
     *
     * @return \Inspetor\Model\InspetorEvent
     */
    public function getInspetorEvent();

    /**
     * Operation getInspetorItem
     *
     * @return \Inspetor\Model\InspetorItem
     */
    public function getInspetorItem();

    /**
     * Operation getInspetorPassRecovery
     *
     * @return \Inspetor\Model\InspetorPassRecovery
     */
    public function getInspetorPassRecovery();

    /**
     * Operation getInspetorPayment
     *
     * @return \Inspetor\Model\InspetorPayment
     */
    public function getInspetorPayment();

    /**
     * Operation getInspetorSale
     *
     * @return \Inspetor\Model\InspetorSale
     */
    public function getInspetorSale();

    /**
     * Operation getInspetorSession
     *
     * @return \Inspetor\Model\InspetorSession
     */
    public function getInspetorSession();

    /**
     * Operation getInspetorTransfer
     *
     * @return \Inspetor\Model\InspetorTransfer
     */
    public function getInspetorTransfer();

    /**
     * Operation trackAccountCreation
     *
     * Send account creation data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorAccount $account account (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorAccountException
     * @return void
     */
    public function trackAccountCreation(InspetorAccount $account);

    /**
     * Operation trackAccountDeletion
     *
     * Send account deletion data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorAccount $account account (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorAccountException
     * @return void
     */
    public function trackAccountDeletion(InspetorAccount $account);

    /**
     * Operation trackAccountUpdate
     *
     * Send account update data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorAccount $account account (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorAccountException
     * @return void
     */
    public function trackAccountUpdate(InspetorAccount $account);

    /**
     * Operation trackEventCreation
     *
     * Send event creation data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorEvent $event event (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorEventException
     * @return void
     */
    public function trackEventCreation(InspetorEvent $event);

    /**
     * Operation trackEventDeletion
     *
     * Send event deletion data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorEvent $event event (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorEventException
     * @return void
     */
    public function trackEventDeletion(InspetorEvent $event);

    /**
     * Operation trackEventUpdate
     *
     * Send event update data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorEvent $event event (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorEventException
     * @return void
     */
    public function trackEventUpdate(InspetorEvent $event);

    /**
     * Operation trackItemTransferCreation
     *
     * Send item transfer creation data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorTransfer $transfer transfer (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorTransferException
     * @return void
     */
    public function trackItemTransferCreation(InspetorTransfer $transfer);

    /**
     * Operation trackItemTransferUpdate
     *
     * Send item transfer update data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorTransfer $transfer transfer (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorTransferException
     * @return void
     */
    public function trackItemTransferUpdate(InspetorTransfer $transfer);

    /**
     * Operation trackLogin
     *
     * Send account login data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorAuth $auth auth (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorAuthException
     * @return void
     */
    public function trackLogin(InspetorAuth $auth);

    /**
     * Operation trackLogout
     *
     * Send account logout data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorAuth $auth auth (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorAuthException
     * @return void
     */
    public function trackLogout(InspetorAuth $auth);

    /**
     * Operation trackPasswordRecovery
     *
     * Send password recovery data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorPassRecovery $pass_recovery pass_recovery (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorPassRecoveryException
     * @return void
     */
    public function trackPasswordRecovery(InspetorPassRecovery $pass_recovery);

    /**
     * Operation trackPasswordReset
     *
     * Send password reset data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorPassRecovery $pass_recovery pass_recovery (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorPassRecoveryException
     * @return void
     */
    public function trackPasswordReset(InspetorPassRecovery $pass_recovery);

    /**
     * Operation trackSaleCreation
     *
     * Send sale creation data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorSale $sale sale (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorSaleException
     * @return void
     */
    public function trackSaleCreation(InspetorSale $sale);

    /**
     * Operation trackSaleUpdate
     *
     * Send sale update data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorSale $sale sale (required);
     *
     * @throws \Inspetor\Exception\TrackerException
     * @throws \Inspetor\Exception\ModelException\InspetorSaleException
     * @return void
     */
    public function trackSaleUpdate(InspetorSale $sale);
}
