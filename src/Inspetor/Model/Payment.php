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

use Inspetor\Exception\PaymentException;
use Inspetor\Model\CreditCard;

class Payment implements JsonSerializable {

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
     * @param array
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
            throw new PaymentException(7801);
        }
        if (!$this->method) {
            throw new PaymentException(7802);
        }
        if (!$this->installments || empty($this->installments)) {
            throw new PaymentException(7803);
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
            throw new PaymentException(7800);
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
                throw new PaymentException(7800);
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
	 * @param boolean $debug  If set as true will decode the value
	 *
	 * @return string
	 */
	public function getId($debug = false) {
        if ($debug) {
            return base64_decode($this->id);
        }
		return $this->id;
    }

	/**
	 * Set the value of id
	 *
	 * @param string  $id
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setId($id, $is_editable = false) {
        if ($is_editable) {
            $this->id = base64_encode($id);
        } else {
            $this->id = $id;
        }
		return $this;
	}

	/**
	 * Get the value of method
	 *
	 * @param boolean $debug  If set as true will decode the value
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
	 * @param boolean $is_editable  If set as true will encode the value
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
	 * @param boolean $debug  If set as true will decode the value
	 *
	 * @return string
	 */
	public function getInstallments($debug = false) {
        if ($debug) {
            return base64_decode($this->installments);
        }
		return $this->installments;
    }

	/**
	 * Set the value of installments
	 *
	 * @param string  $installments
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setInstallments($installments, $is_editable = true) {
        if ($is_editable) {
            $this->installments = base64_encode($installments);
        } else {
            $this->installments = $installments;
        }
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
            "payment_instance_id"               => $this->getId(),
            "payment_instance_method"           => $this->getMethod(),
            "payment_instance_installments"     => $this->getInstallments(),
            "payment_instance_credit_card_info" => $this->getCreditCard()
        ];

        return $array;
    }

}


?>