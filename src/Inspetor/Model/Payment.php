<?php
/**
 * Account
 *
 * PHP version 5
 *
 * @category Class
 * @package  Inspetor\Model
 * @author   Inspetor Team
 * @link     ""
 */

/**
 * Inspetor Antifraud
 *
 * This is an antifraud product developed to analyzes transactions and identify frauds using trackers and analytics tools. This file must explain every request and parametes that a library must provide to a client.
 *
 * Contact: theo@useinspetor.com
 */

namespace Inspetor\Model;

use Inspetor\Exception\ModelException\PaymentException;
use Inspetor\Model\CreditCard;
use Inspetor\Model\AbstractModel;
use JsonSerializable;

class Payment extends AbstractModel implements JsonSerializable {

    const CREDIT_CARD  = "credit_card";
    const BOLETO       = "boleto";
    const OTHER_METHOD = "other";

    /**
     * PROPERTIES
     */

    /**
     * @param string
     */
    private $id;

    /**
     * @param string
     */
    private $method;

    /**
     * @param string
     */
    private $installments;

    /**
     * @param Inspetor\Model\CreditCard $credit_card
     */
    private $credit_card;


    /**
     * ISVALID
     */

	/**
     * Validate Payment instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->id) {
            throw new PaymentException(7001);
        }
        if (!$this->method) {
            throw new PaymentException(7002);
        }
        if (!$this->installments) {
            throw new PaymentException(7003);
        }
    }

    /**
	 * Validate method of the payment
	 *
	 * @return void
	 */
    private function validateMethod() {
        $all_methods = [
            self::BOLETO,
            self::CREDIT_CARD,
            self::OTHER_METHOD,
        ];

        if (!in_array($this->method, $all_methods)) {
            throw new PaymentException(7000);
        }
        $this->validateCreditCardInfo();
    }

    /**
	 * Validate credit card info
	 *
	 * @return boolean
	 */
    private function validateCreditCardInfo() {
        if ($this->getMethod() == self::CREDIT_CARD) {
            if (!$this->getCreditCard()) {
                throw new PaymentException(7000);
            }
        }
        return true;
    }

    /**
     * GETTERS AND SETTERS
     */

	/**
	 * Get the value of id
	 *
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
    }

	/**
	 * Set the value of id
	 *
	 * @param string  $id
	 *
	 * @return self
	 */
	public function setId($id) {
        $this->id = $id;
		return $this;
	}

	/**
	 * Get the value of method
	 *
	 *
	 * @return string
	 */
	public function getMethod() {
		return $this->method;
    }

	/**
	 * Set the value of method
	 *
	 * @param string  $method
	 *
	 * @return self
	 */
	public function setMethod($method) {
        $this->method = $method;
		return $this;
	}

	/**
	 * Get the value of installments
	 *
	 * @return string
	 */
	public function getInstallments() {
		return $this->installments;
    }

	/**
	 * Set the value of installments
	 *
	 * @param string  $installments
	 *
	 * @return self
	 */
	public function setInstallments($installments) {
        $this->installments = $installments;
		return $this;
	}

	/**
	 * Get the value of credit_card
	 *
	 * @return Inspetor\Model\CreditCard
	 */
	public function getCreditCard() {
		return $this->credit_card;
    }

	/**
	 * Set the value of credit_card
	 *
	 * @param Inspetor\Model\CreditCard $credit_card
	 *
	 * @return self
	 */
	public function setCreditCard($credit_card) {
        if ($credit_card) {
            $credit_card->isValid();
        }
        $this->credit_card = $credit_card;
		return $this;
    }

    /**
     * JSONSERIALIZE
    */

    /**
     * Create a json with the data from the object
     * @return array
    */
    public function jsonSerialize() {
        $array = [
            "payment_instance_id"               => $this->encodeData($this->getId()),
            "payment_instance_method"           => $this->encodeData($this->getMethod()),
            "payment_instance_installments"     => $this->encodeData($this->getInstallments()),
            "payment_instance_credit_card_info" => $this->encodeObject($this->getCreditCard())
        ];

        return $array;
    }

}


?>