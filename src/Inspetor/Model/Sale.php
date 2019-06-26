<?php
/**
 * Address
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

class Sale implements JsonSerializable {

    const SALE_CREATE_ACTION = "sale_create";
    const SALE_UPDATE_STATUS_ACTION = "sale_update_status";

    const ACCEPTED_STATUS = "accepted";
    const DECLINED_STATUS = "declined";
    const PENDING_STATUS = "pending";
    const REFUNDED_STATUS = "refunded";
    const MANUAL_ANALYSIS_STATUS = "manual_analysis";

    /**
     * PROPERTIES
     */

    var $id;
    var $account_id;
    private $total_value;
    var $status;
    var $is_fraud;
    var $timestamp;
    var $items;
    var $payment;

    public function isValid() {
        if ($this->id == null || $this->id == "") {
            throw new Exception("Id can't be null");
        }
        if ($this->account_id == null || $this->account_id == "") {
            throw new Exception("Account id can't be null");
        }
        if ($this->status == null || $this->status == "") {
            throw new Exception("Id can't be null");
        }
        
        $this->validateStatus();

        if ($this->is_fraud == null || $this->is_fraud == "") {
            throw new Exception("Is Fraud property can't be null");
        }
        if ($this->timestamp == null || $this->timestamp == "") {
            throw new Exception("Timestamp can't be null");
        }
        if ($this->items == null || $this->items == "" || empty($this->items)) {
            throw new Exception("Items can't be null neither an empty array");
        }
        if ($this->payment == null || $this->payment == "") {
            throw new Exception("Payment can't be null");
        }

        $this->getTotalValue();
    }

    private function validateStatus() {
        $all_status = [
            self::ACCEPTED,
            self::DECLINED,
            self::PENDING,
            self::REFUNDED,
            self::MANUAL_ANALYSIS,
        ];

        if (!in_array($this->status, $all_status)) {
            throw new Exception("Status is not a valid one");
        }
    }

    private function getTotalValue() {
        foreach ($this->items as $item) {
            try {
                $this->total_value += floatval($item->getPrice(true));
            } catch (Exception $e) {
                throw new Exception("Price values in the items are not valid ones");
            }
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
	public function setId($id, $is_editable = true) {
        if ($is_editable) {
            $this->id = base64_encode($id);
        } else {
            $this->id = $id;
        }
		return $this;
	}

	/**
	 * Get the value of account_id
	 * 
	 * @param   boolean $debug  If set as true will decode the value
	 *
	 * @return  mixed
	 */
	public function getAccountId($debug = false) {
        if ($debug) {
            return base64_decode($this->account_id);
        }
		return $this->account_id;
    }

	/**
	 * Set the value of account_id
	 *
	 * @param   mixed  $account_id  
	 * @param   boolean $is_editable  If set as true will encode the value
	 * 
	 * @return  self
	 */
	public function setAccountId($account_id, $is_editable = true) {
        if ($is_editable) {
            $this->account_id = base64_encode($account_id);
        } else {
            $this->account_id = $account_id;
        }
		return $this;
	}

	/**
	 * Get the value of status
	 * 
	 * @param   boolean $debug  If set as true will decode the value
	 *
	 * @return  mixed
	 */
	public function getStatus() {
		return $this->status;
    }

	/**
	 * Set the value of status
	 *
	 * @param   mixed  $status  
	 * @param   boolean $is_editable  If set as true will encode the value
	 * 
	 * @return  self
	 */
	public function setStatus($status) {
        $this->status = $status;
		return $this;
	}

	/**
	 * Get the value of is_fraud
	 * 
	 * @param   boolean $debug  If set as true will decode the value
	 *
	 * @return  mixed
	 */
	public function getIsFraud() {
		return $this->is_fraud;
    }

	/**
	 * Set the value of is_fraud
	 *
	 * @param   mixed  $is_fraud  
	 * @param   boolean $is_editable  If set as true will encode the value
	 * 
	 * @return  self
	 */
	public function setIsFraud($is_fraud) {
        $this->is_fraud = $is_fraud;
		return $this;
	}

	/**
	 * Get the value of timestamp
	 * 
	 * @param   boolean $debug  If set as true will decode the value
	 *
	 * @return  mixed
	 */
	public function getTimestamp() {
		return $this->timestamp;
    }

	/**
	 * Set the value of timestamp
	 *
	 * @param   mixed  $timestamp  
	 * @param   boolean $is_editable  If set as true will encode the value
	 * 
	 * @return  self
	 */
	public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
		return $this;
	}

	/**
	 * Get the value of items
	 * 
	 * @param   boolean $debug  If set as true will decode the value
	 *
	 * @return  mixed
	 */
	public function getItems() {
		return $this->items;
    }

	/**
	 * Set the value of items
	 *
	 * @param   mixed  $items  
	 * @param   boolean $is_editable  If set as true will encode the value
	 * 
	 * @return  self
	 */
	public function setItems($items) {
        $this->items = $items;
		return $this;
	}

	/**
	 * Get the value of payment
	 * 
	 * @param   boolean $debug  If set as true will decode the value
	 *
	 * @return  mixed
	 */
	public function getPayment() {
		return $this->payment;
    }

	/**
	 * Set the value of payment
	 *
	 * @param   mixed  $payment  
	 * @param   boolean $is_editable  If set as true will encode the value
	 * 
	 * @return  self
	 */
	public function setPayment($payment) {
        $this->payment = $payment;
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
            "sale_id" => $this->getId(),
            "sale_account_id" => $this->getAccountId(),
            "sale_total_value" => $this->total_value,
            "sale_status" => $this->getStatus(),
            "sale_is_fraud" => $this->getIsFraud(),
            "sale_timestamp" => $this->getTimestamp(),
            "sale_items" => $this->getItems()->jsonSerialize(),
            "sale_payement_instance" => $this->getPayment()->jsonSerialize()
        ];

        return $array;
    }
}

?>