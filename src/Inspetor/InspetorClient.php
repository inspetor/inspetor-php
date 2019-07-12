<?php


namespace Inspetor;

use Inspetor\Model\InspetorAccount;
use Inspetor\Model\InspetorAddress;
use Inspetor\Model\InspetorAuth;
use Inspetor\Model\InspetorCreditCard;
use Inspetor\Model\InspetorEvent;
use Inspetor\Model\InspetorItem;
use Inspetor\Model\InspetorPassRecovery;
use Inspetor\Model\InspetorPayment;
use Inspetor\Model\InspetorSale;
use Inspetor\Model\InspetorTransfer;
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
     * @param Inspetor\Model\InspetorSale $sale
     * @return void
     */
    public function trackSaleCreation(InspetorSale $sale) {
        try {
            $this->inspetor_resource->trackSaleAction(
                $sale,
                InspetorSale::SALE_CREATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackSaleUpdate
     *
     * @param Inspetor\Model\InspetorSale $sale
     * @return void
     */
    public function trackSaleUpdate(InspetorSale $sale) {
        try {
            $this->inspetor_resource->trackSaleAction(
                $sale,
                InspetorSale::SALE_UPDATE_STATUS_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackAccountCreation
     *
     * @param Inspetor\Model\InspetorAccount $account
     * @return void
     */
    public function trackAccountCreation(InspetorAccount $account) {
        try {
            $this->inspetor_resource->trackAccountAction(
                $account,
                InspetorAccount::ACCOUNT_CREATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackAccountUpdate
     *
     * @param Inspetor\Model\InspetorAccount $account
     * @return void
     */
    public function trackAccountUpdate(InspetorAccount $account) {
        try {
            $this->inspetor_resource->trackAccountAction(
                $account,
                InspetorAccount::ACCOUNT_UPDATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackAccountDeletion
     *
     * @param Inspetor\Model\InspetorAccount $account
     * @return void
     */
    public function trackAccountDeletion(InspetorAccount $account) {
        try {
            $this->inspetor_resource->trackAccountAction(
                $account,
                InspetorAccount::ACCOUNT_DELETE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackEventCreation
     *
     * @param Inspetor\Model\InspetorEvent $event
     * @return void
     */
    public function trackEventCreation(InspetorEvent $event) {
        try {
            $this->inspetor_resource->trackEventAction(
                $event,
                InspetorEvent::EVENT_CREATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackEventUpdate
     *
     * @param Inspetor\Model\InspetorEvent $event
     * @return void
     */
    public function trackEventUpdate(InspetorEvent $event) {
        try {
            $this->inspetor_resource->trackEventAction(
                $event,
                InspetorEvent::EVENT_UPDATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackEventDeletion
     *
     * @param Inspetor\Model\InspetorEvent $event
     * @return void
     */
    public function trackEventDeletion(InspetorEvent $event) {
        try {
            $this->inspetor_resource->trackEventAction(
                $event,
                InspetorEvent::EVENT_DELETE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackItemTransferCreation
     *
     * @param Inspetor\Model\InspetorTransfer $transfer
     * @return void
     */
    public function trackItemTransferCreation(InspetorTransfer $transfer) {
        try {
            $this->inspetor_resource->trackItemTransferAction(
                $transfer,
                InspetorTransfer::TRANSFER_CREATE_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackItemTransferUpdate
     *
     * @param Inspetor\Model\InspetorTransfer $transfer
     * @return void
     */
    public function trackItemTransferUpdate(InspetorTransfer $transfer) {
        try {
            $this->inspetor_resource->trackItemTransferAction(
                $transfer,
                InspetorTransfer::TRANSFER_UPDATE_STATUS_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackLogin
     *
     * @param Inspetor\Model\InspetorAuth $auth
     * @return void
     */
    public function trackLogin(InspetorAuth $auth) {
        try {
            $this->inspetor_resource->trackAccountAuthAction(
                $auth,
                InspetorAuth::ACCOUNT_LOGIN_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackLogout
     *
     * @param Inspetor\Model\InspetorAuth $auth
     * @return void
     */
    public function trackLogout(InspetorAuth $auth) {
        try {
            $this->inspetor_resource->trackAccountAuthAction(
                $auth,
                InspetorAuth::ACCOUNT_LOGOUT_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackPasswordReset
     *
     * @param Inspetor\Model\InspetorPassRecovery $pass_recovery
     * @return void
     */
    public function trackPasswordReset(InspetorPassRecovery $pass_recovery) {
        try {
            $this->inspetor_resource->trackPasswordRecoveryAction(
                $pass_recovery,
                InspetorPassRecovery::PASSWORD_RESET_ACTION
            );
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * trackPasswordRecovery
     *
     * @param Inspetor\Model\InspetorPassRecovery $pass_recovery
     * @return void
     */
    public function trackPasswordRecovery(InspetorPassRecovery $pass_recovery) {
        try {
            $this->inspetor_resource->trackPasswordRecoveryAction(
                $pass_recovery,
                InspetorPassRecovery::PASSWORD_RECOVERY_ACTION
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
        return new InspetorAccount();
    }

    /**
     * getInspetorAddress
     *
     * @return Address
     */
    public function getInspetorAddress() {
        return new InspetorAddress();
    }

    /**
     * getInspetorAuth
     *
     * @return Auth
     */
    public function getInspetorAuth() {
        return new InspetorAuth();
    }

    /**
     * getInspetorCreditCard
     *
     * @return CreditCard
     */
    public function getInspetorCreditCard() {
        return new InspetorCreditCard();
    }

    /**
     * getInspetorEvent
     *
     * @return Event
     */
    public function getInspetorEvent() {
        return new InspetorEvent();
    }

    /**
     * getInspetorItem
     *
     * @return Item
     */
    public function getInspetorItem() {
        return new InspetorItem();
    }

    /**
     * getInspetorPassRecovery
     *
     * @return PassRecovery
     */
    public function getInspetorPassRecovery() {
        return new InspetorPassRecovery();
    }

    /**
     * getInspetorPayment
     *
     * @return Payment
     */
    public function getInspetorPayment() {
        return new InspetorPayment();
    }

    /**
     * getInspetorSale
     *
     * @return Sale
     */
    public function getInspetorSale() {
        return new InspetorSale();
    }

    /**
     * getInspetorTransfer
     *
     * @return Transfer
     */
    public function getInspetorTransfer() {
        return new InspetorTransfer();
    }

}
