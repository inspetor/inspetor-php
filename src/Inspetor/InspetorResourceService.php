<?php
/**
 * InspetorApi
 * PHP version 5
 *
 * @category Class
 * @package  Inspetor\Client
 * @author   Inspetor Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Inspetor Antifraud
 *
 * This is an antifraud product developed to analyzes transactions and identify frauds using trackers and analytics tools. This file must explain every request and parametes that a library must provide to a client.
 *
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
 * InspetorServer Interface Doc Comment
 *
 * @category Class
 * @package  Inspetor
 * @author   Inspetor Team
 */
interface InspetorResourceService {

    /**
     * Operation trackAccountAction
     *
     * Send account data to Inspetor
     *
     * @param  \Inspetor\Model\Account $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\AccountException
     * @return void
     */
    public function trackAccountAction(Account $data, string $action);
    /**
     * Operation trackEventAction
     *
     * Send event data to Inspetor
     *
     * @param  \Inspetor\Model\Event $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\EventException
     * @return void
     */
    public function trackEventAction(Event $data, string $action);
    /**
     * Operation trackPasswordRecoveryAction
     *
     * Send pass recovery data to Inspetor
     *
     * @param  \Inspetor\Model\PassRecovery $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\PassRecoveryException
     * @return void
     */
    public function trackPasswordRecoveryAction(PassRecovery $data, string $action);
    /**
     * Operation trackItemTransferAction
     *
     * Send ticket transfer data to Inspetor
     *
     * @param  \Inspetor\Model\Transfer $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\TransferException
     * @return void
     */
    public function trackItemTransferAction(Transfer $data, string $action);
    /**
     * Operation trackSaleAction
     *
     * Send transaction data to Inspetor
     *
     * @param  \Inspetor\Model\Sale $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\SaleException
     * @return void
     */
    public function trackSaleAction(Sale $data, string $action);
    /**
     * Operation trackAccountAuthAction
     *
     * Send auth data to Inspetor
     *
     * @param  \Inspetor\Model\Auth $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\AuthException
     * @return void
     */
    public function trackAccountAuthAction(Auth $data, string $action);
}
