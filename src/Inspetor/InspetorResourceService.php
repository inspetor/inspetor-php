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
 *
 */
namespace Inspetor;

use Inspetor\Model\InspetorAccount;
use Inspetor\Model\InspetorAuth;
use Inspetor\Model\InspetorEvent;
use Inspetor\Model\InspetorPassRecovery;
use Inspetor\Model\InspetorSale;
use Inspetor\Model\InspetorTransfer;

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
     * @param  \Inspetor\Model\InspetorAccount $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\InspetorAccountException
     * @return void
     */
    public function trackAccountAction(InspetorAccount $data, string $action);

    /**
     * Operation trackEventAction
     *
     * Send event data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorEvent $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\InspetorEventException
     * @return void
     */

    public function trackEventAction(InspetorEvent $data, string $action);
    /**
     * Operation trackPasswordRecoveryAction
     *
     * Send pass recovery data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorPassRecovery $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\InspetorPassRecoveryException
     * @return void
     */
    public function trackPasswordRecoveryAction(InspetorPassRecovery $data, string $action);

    /**
     * Operation trackItemTransferAction
     *
     * Send ticket transfer data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorTransfer $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\InspetorTransferException
     * @return void
     */
    public function trackItemTransferAction(InspetorTransfer $data, string $action);

    /**
     * Operation trackSaleAction
     *
     * Send transaction data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorSale $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\InspetorSaleException
     * @return void
     */
    public function trackSaleAction(InspetorSale $data, string $action);

    /**
     * Operation trackAccountAuthAction
     *
     * Send auth data to Inspetor
     *
     * @param  \Inspetor\Model\InspetorAuth $data data (required)
     * @param  string $action action (required)
     *
     * @throws \Inspetor\Exception\ModelException\InspetorAuthException
     * @return void
     */
    public function trackAccountAuthAction(InspetorAuth $data, string $action);
}
