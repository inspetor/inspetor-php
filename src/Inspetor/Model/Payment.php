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

class Payment implements JsonSerializable {

    const CREDIT_CARD = "credit_card";
    const BOLETO = "boleto";
    const OTHER_METHOD = "other";

    /**
     * PROPERTIES
     */

    var $id;
    var $method;
    var $installments;
    var $credit_card;

    /**
     * ISVALID
     */

    public function isValid() {
        if ($this->id == null || $this->id == "") {
            throw new Exception("Id can't be null");
        }
        if ($this->method == null || $this->method == "") {
            throw new Exception("Method can't be null");
        }
        if ($this->installments == null || $this->installments == "") {
            throw new Exception("Installments can't be null");
        }
    }

    private function validateMethod() {
        $all_methods = [
            self::BOLETO,
            self::CREDIT_CARD,
            self::OTHER_METHOD,
        ];

        if (!in_array($this->method, $all_methods)) {
            throw new Exception("Method is not a valid one");
        }
    }

    /**
     * GETTERS AND SETTERS
     */
    
	/**
	 * Get the value of id
	 * 
	 * @param   boolean $debug  If set as true will decode the value
	 *
	 * @return  mixed
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
	 * @param   mixed  $id  
	 * @param   boolean $is_editable  If set as true will encode the value
	 * 
	 * @return  self
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
	 * @param   boolean $debug  If set as true will decode the value
	 *
	 * @return  mixed
	 */
	public function getMethod() {
		return $this->method;
    }

	/**
	 * Set the value of method
	 *
	 * @param   mixed  $method  
	 * @param   boolean $is_editable  If set as true will encode the value
	 * 
	 * @return  self
	 */
	public function setMethod($method) {
        $this->method = $method;
		return $this;
	}

	/**
	 * Get the value of installments
	 * 
	 * @param   boolean $debug  If set as true will decode the value
	 *
	 * @return  mixed
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
	 * @param   mixed  $installments  
	 * @param   boolean $is_editable  If set as true will encode the value
	 * 
	 * @return  self
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
	 * @param   boolean $debug  If set as true will decode the value
	 *
	 * @return  mixed
	 */
	public function getCreditCard() {
		return $this->credit_card;
    }

	/**
	 * Set the value of credit_card
	 *
	 * @param   mixed  $credit_card  
	 * @param   boolean $is_editable  If set as true will encode the value
	 * 
	 * @return  self
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
            "payment_instance_id" => $this->getId(),
            "payment_instance_method" => $this->getMethod(),
            "payment_instance_installments" => $this->getInstallments(),
            "payment_instance_credit_card_info" => $this->getCreditCard()
        ];

        return $array;
    }

}


?>