<?php


namespace Inspetor;

use Inspetor\Model\Account;
use Inspetor\Model\Address;
use Inspetor\Model\Auth;
use Inspetor\Model\CreditCard;
use Inspetor\Model\Event;
use Inspetor\Model\Item;
use Inspetor\Model\PassRecovery;
use Inspetor\Model\Payment;
use Inspetor\Model\Sale;
use Inspetor\Model\Transfer;
use Inspetor\InspetorResource;
use Inspetor\InspetorService;

class InspetorClient implements InspetorService {

    /**
     * inspetor_resource
     *
     * @var InspetorResource
     */
    private $inspetor_resource;

    /**
     * Construct
     *
     * @param array $config
     */
    public function __construct(array $config) {
        try {
            $this->inspetor_resource = new InspetorResource($config);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * trackSaleCreation
     *
     * @param Sale $sale
     * @return void
     */
    public function trackSaleCreation(Sale $sale) {
        try {
            $this->inspetor_resource->trackSaleAction(
                $sale,
                SALE::SALE_CREATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackSaleUpdate
     *
     * @param Sale $sale
     * @return void
     */
    public function trackSaleUpdate(Sale $sale) {
        try {
            $this->inspetor_resource->trackSaleAction(
                $sale,
                SALE::SALE_UPDATE_STATUS_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackAccountCreation
     *
     * @param Account $account
     * @return void
     */
    public function trackAccountCreation(Account $account) {
        try {
            $this->inspetor_resource->trackAccountAction(
                $account,
                ACCOUNT::ACCOUNT_CREATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackAccountUpdate
     *
     * @param Account $account
     * @return void
     */
    public function trackAccountUpdate(Account $account) {
        try {
            $this->inspetor_resource->trackAccountAction(
                $account,
                ACCOUNT::ACCOUNT_UPDATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackAccountDeletion
     *
     * @param Account $account
     * @return void
     */
    public function trackAccountDeletion(Account $account) {
        try {
            $this->inspetor_resource->trackAccountAction(
                $account,
                ACCOUNT::ACCOUNT_DELETE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackEventCreation
     *
     * @param Event $event
     * @return void
     */
    public function trackEventCreation(Event $event) {
        try {
            $this->inspetor_resource->trackEventAction(
                $event,
                EVENT::EVENT_CREATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackEventUpdate
     *
     * @param Event $event
     * @return void
     */
    public function trackEventUpdate(Event $event) {
        try {
            $this->inspetor_resource->trackEventAction(
                $event,
                EVENT::EVENT_UPDATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackEventDeletion
     *
     * @param Event $event
     * @return void
     */
    public function trackEventDeletion(Event $event) {
        try {
            $this->inspetor_resource->trackEventAction(
                $event,
                EVENT::EVENT_DELETE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackItemTransferCreation
     *
     * @param Transfer $transfer
     * @return void
     */
    public function trackItemTransferCreation(Transfer $transfer) {
        try {
            $this->inspetor_resource->trackItemTransferAction(
                $transfer,
                TRANSFER::TRANSFER_CREATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackItemTransferUpdate
     *
     * @param Transfer $transfer
     * @return void
     */
    public function trackItemTransferUpdate(Transfer $transfer) {
        try {
            $this->inspetor_resource->trackItemTransferAction(
                $transfer,
                TRANSFER::TRANSFER_UPDATE_STATUS_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackLogin
     *
     * @param Auth $auth
     * @return void
     */
    public function trackLogin(Auth $auth) {
        try {
            $this->inspetor_resource->trackAccountAuthAction(
                $auth,
                AUTH::ACCOUNT_LOGIN_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackLogout
     *
     * @param Auth $auth
     * @return void
     */
    public function trackLogout(Auth $auth) {
        try {
            $this->inspetor_resource->trackAccountAuthAction(
                $auth,
                AUTH::ACCOUNT_LOGOUT_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackPasswordReset
     *
     * @param PassRecovery $pass_recovery
     * @return void
     */
    public function trackPasswordReset(PassRecovery $pass_recovery) {
        try {
            $this->inspetor_resource->trackPasswordRecoveryAction(
                $pass_recovery,
                PASSRECOVERY::PASSWORD_RESET_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackPasswordRecovery
     *
     * @param PassRecovery $pass_recovery
     * @return void
     */
    public function trackPasswordRecovery(PassRecovery $pass_recovery) {
        try {
            $this->inspetor_resource->trackPasswordRecoveryAction(
                $pass_recovery,
                PASSRECOVERY::PASSWORD_RECOVERY_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * getInspetorAccount
     *
     * @return Account
     */
    public function getInspetorAccount() {
        return new Account();
    }

    /**
     * getInspetorAddress
     *
     * @return Address
     */
    public function getInspetorAddress() {
        return new Address();
    }

    /**
     * getInspetorAuth
     *
     * @return Auth
     */
    public function getInspetorAuth() {
        return new Auth();
    }

    /**
     * getInspetorCreditCard
     *
     * @return CreditCard
     */
    public function getInspetorCreditCard() {
        return new CreditCard();
    }

    /**
     * getInspetorEvent
     *
     * @return Event
     */
    public function getInspetorEvent() {
        return new Event();
    }

    /**
     * getInspetorItem
     *
     * @return Item
     */
    public function getInspetorItem() {
        return new Item();
    }

    /**
     * getInspetorPassRecovery
     *
     * @return PassRecovery
     */
    public function getInspetorPassRecovery() {
        return new PassRecovery();
    }

    /**
     * getInspetorPayment
     *
     * @return Payment
     */
    public function getInspetorPayment() {
        return new Payment();
    }

    /**
     * getInspetorSale
     *
     * @return Sale
     */
    public function getInspetorSale() {
        return new Sale();
    }

    /**
     * getInspetorTransfer
     *
     * @return Transfer
     */
    public function getInspetorTransfer() {
        return new Transfer();
    }

}
