<?php


namespace Inspetor\Inspetor;

use Inspetor\Model\Account;
use Inspetor\Model\Auth;
use Inspetor\Model\Event;
use Inspetor\Model\PassRecovery;
use Inspetor\Model\Sale;
use Inspetor\Model\Transfer;

use Inspetor\InspetorClient;
use Inspetor\Model\Category;
use Inspetor\Model\Payment;

class Inspetor {

    /**
     * inspetor_client
     *
     * @var InspetorClient
     */
    private $inspetor_client;

    /**
     * Construct
     *
     * @param array $config
     */
    public function __construct(array $config) {
        $this->inspetor_client($config);
    }
    
    /**
     * trackSaleCreation
     *
     * @param Sale $sale
     * @return void
     */
    public function trackSaleCreation(Sale $sale) {
        $this->inspetor_client->trackSaleAction($sale, SALE::SALE_CREATE_ACTION);
    }

    /**
     * trackSaleUpdate
     *
     * @param Sale $sale
     * @return void
     */
    public function trackSaleUpdate(Sale $sale) {
        $this->inspetor_client->trackSaleAction($sale, SALE::SALE_UPDATE_STATUS_ACTION);
    }

    /**
     * trackAccountCreation
     *
     * @param Account $account
     * @return void
     */
    public function trackAccountCreation(Account $account) {
        $this->inspetor_client->trackAccountAction($account, ACCOUNT::ACCOUNT_CREATE_ACTION);
    }

    /**
     * trackAccountUpdate
     *
     * @param Account $account
     * @return void
     */
    public function trackAccountUpdate(Account $account) {
        $this->inspetor_client->trackAccountAction($account, ACCOUNT::ACCOUNT_UPDATE_ACTION);
    }

    /**
     * trackAccountDeletion
     *
     * @param Account $account
     * @return void
     */
    public function trackAccountDeletion(Account $account) {
        $this->inspetor_client->trackAccountAction($account, ACCOUNT::ACCOUNT_DELETE_ACTION);
    }

    /**
     * trackEventCreation
     *
     * @param Event $event
     * @return void
     */
    public function trackEventCreation(Event $event) {
        $this->inspetor_client->trackEventAction($event, EVENT::CREATE_ACTION);
    }

    /**
     * trackEventUpdate
     *
     * @param Event $event
     * @return void
     */
    public function trackEventUpdate(Event $event) {
        $this->inspetor_client->trackEventAction($event, EVENT::UPDATE_ACTION);
    }

    /**
     * trackEventDeletion
     *
     * @param Event $event
     * @return void
     */
    public function trackEventDeletion(Event $event) {
        $this->inspetor_client->trackEventAction($event, EVENT::DELETE_ACTION);
    }

    /**
     * trackItemTransferCreation
     *
     * @param Transfer $transfer
     * @return void
     */
    public function trackItemTransferCreation(Transfer $transfer) {
        $this->inspetor_client->trackItemTransferAction($transfer, TRANSFER::TRANSFER_CREATE_ACTION);
    }

    /**
     * trackItemTransferUpdate
     *
     * @param Transfer $transfer
     * @return void
     */
    public function trackItemTransferUpdate(Transfer $transfer) {
        $this->inspetor_client->trackItemTransferAction($transfer, TRANSFER::TRANSFER_UPDATE_STATUS_ACTION);
    }

    /**
     * trackLogin
     *
     * @param Auth $auth
     * @return void
     */
    public function trackLogin(Auth $auth) {
        $this->inspetor_client->trackAccountAuthAction($auth, AUTH::ACCOUNT_LOGIN_ACTION);
    }

    /**
     * trackLogout
     *
     * @param Auth $auth
     * @return void
     */
    public function trackLogout(Auth $auth) {
        $this->inspetor_client->trackAccountAuthAction($auth, AUTH::ACCOUNT_LOGOUT_ACTION);
    }

    /**
     * trackPasswordReset
     *
     * @param PassRecovery $pass_recovery
     * @return void
     */
    public function trackPasswordReset(PassRecovery $pass_recovery) {
        $this->inspetor_client->trackPasswordRecoveryAction($pass_recovery, PASSRECOVERY::PASSWORD_RESET_ACTION);
    }

    /**
     * trackPasswordRecovery
     *
     * @param PassRecovery $pass_recovery
     * @return void
     */
    public function trackPasswordRecovery(PassRecovery $pass_recovery) {
        $this->inspetor_client->trackPasswordRecoveryAction($pass_recovery, PASSRECOVERY::PASSWORD_RECOVERY_ACTION);
    }

    /**
     * getNewAccount
     *
     * @return Account
     */
    public function getNewAccount() {
        return new Account();
    }

    /**
     * getNewAuth
     *
     * @return Auth
     */
    public function getNewAuth() {
        return new Auth();
    }

    /**
     * getNewCategory
     *
     * @return Category
     */
    public function getNewCategory() {
        return new Category();
    }

    /**
     * getNewCreditCard
     *
     * @return CreditCard
     */
    public function getNewCreditCard() {
        return new CreditCard();
    }

    /**
     * getNewEvent
     *
     * @return Event
     */
    public function getNewEvent() {
        return new Event();
    }
    
    /**
     * getNewItem
     *
     * @return Item
     */
    public function getNewItem() {
        return new Item();
    }

    /**
     * getNewPassRecovery
     *
     * @return PassRecovery
     */
    public function getNewPassRecovery() {
        return new PassRecovery();
    }

    /**
     * getNewPayment
     *
     * @return Payment
     */
    public function getNewPayment() {
        return new Payment();
    }

    /**
     * getNewSale
     *
     * @return Sale
     */
    public function getNewSale() {
        return new Sale();
    }

    /**
     * getNewTransfer
     *
     * @return Transfer
     */
    public function getNewTransfer() {
        return new Transfer();
    }

}
