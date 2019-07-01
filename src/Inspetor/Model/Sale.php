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

use Inspetor\Exception\ModelException\SaleException;
use Inspetor\Model\Item;
use Inspetor\Model\Payment;
use Inspetor\Model\AbstractModel;
use JsonSerializable;

class Sale extends AbstractModel implements JsonSerializable {

    const SALE_CREATE_ACTION        = "sale_create";
    const SALE_UPDATE_STATUS_ACTION = "sale_update_status";

    const ACCEPTED_STATUS        = "accepted";
    const DECLINED_STATUS        = "declined";
    const PENDING_STATUS         = "pending";
    const REFUNDED_STATUS        = "refunded";
    const MANUAL_ANALYSIS_STATUS = "manual_analysis";

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
	private $account_id;

    /**
	 * @param string
	 */
	private $total_value;

    /**
	 * @param string
	 */
	private $status;

    /**
	 * @param boolean
	 */
	private $is_fraud;

    /**
	 * @param string
	 */
	private $creation_timestamp;

    /**
	 * @param string
	 */
	private $update_timestamp;

    /**
	 * @param array
	 */
	private $items;

    /**
	 * @param Inspetor\Model\Payment
	 */
	private $payment;

	/**
     * Validate Sale instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->id) {
            throw new SaleException(7901);
        }

		if (!$this->account_id) {
            throw new SaleException(7902);
        }

		if (!$this->status) {
            throw new SaleException(7903);
        }

        $this->validateStatus();

		if (!$this->is_fraud) {
            throw new SaleException(7904);
        }

		if (!$this->creation_timestamp) {
            throw new SaleException(7905);
        }

		if (!$this->update_timestamp) {
            throw new SaleException(7906);
        }

		if (!$this->items || empty($this->items)) {
            throw new SaleException(7907);
        }

		if (!$this->payment) {
            throw new SaleException(7908);
        }

        $this->setTotalValue();
    }

	/**
	 * Validate status of the Sale
	 *
	 * @return void
	 */
    private function validateStatus() {
        $all_status = [
            self::ACCEPTED,
            self::DECLINED,
            self::PENDING,
            self::REFUNDED,
            self::MANUAL_ANALYSIS,
        ];

        if (!in_array($this->status, $all_status)) {
            throw new SaleException(7909);
        }
    }

	/**
	 * Set total value of the sale
	 *
	 * @return void
	 */
    private function setTotalValue() {
        foreach ($this->items as $item) {
            try {
                $this->total_value += floatval($item->getPrice());
            } catch (Exception $e) {
                throw new SaleException(7910);
            }
        }
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
	 * Get the value of account_id
	 *
	 *
	 * @return string
	 */
	public function getAccountId() {
		return $this->account_id;
    }

	/**
	 * Set the value of account_id
	 *
	 * @param string  $account_id
	 *
	 * @return self
	 */
	public function setAccountId($account_id) {
        $this->account_id = $account_id;
		return $this;
    }

    /**
	 * Get the value of total_value
	 *
	 *
	 * @return string
	 */
	public function getTotalValue() {
		return $this->total_value;
    }

	/**
	 * Get the value of status
	 *
	 *
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
    }

	/**
	 * Set the value of status
	 *
	 * @param string  $status
	 *
	 * @return self
	 */
	public function setStatus($status) {
        $this->status = $status;
		return $this;
	}

	/**
	 * Get the value of is_fraud
	 *
	 *
	 * @return boolean
	 */
	public function getIsFraud() {
		return $this->is_fraud;
    }

	/**
	 * Set the value of is_fraud
	 *
	 * @param boolean $is_fraud
	 *
	 * @return self
	 */
	public function setIsFraud($is_fraud) {
        $this->is_fraud = $is_fraud;
		return $this;
	}

	/**
	 * Get the value of timestamp
	 *
	 * @return string
	 */
	public function getCreationTimestamp() {
		return $this->creation_timestamp;
    }

	/**
	 * Set the value of timestamp
	 *
	 * @param string  $timestamp
	 *
	 * @return self
	 */
	public function setCreationTimestamp($creation_timestamp) {
        $this->creation_timestamp = $this->inspetorDateFormatter(
			$creation_timestamp
		);
		return $this;
    }

    /**
	 * Get the value of update_timestamp
	 *
	 *
	 * @return string
	 */
	public function getUpdateTimestamp() {
		return $this->update_timestamp;
    }

	/**
	 * Set the value of update_timestamp
	 *
	 * @param string  $update_timestamp
	 *
	 * @return self
	 */
	public function setUpdateTimestamp($update_timestamp) {
        $this->update_timestamp = $this->inspetorDateFormatter(
			$update_timestamp
		);
		return $this;
	}

	/**
	 * Get the value of items
	 *
	 * @return array
	 */
	public function getItems() {
		return $this->items;
    }

	/**
	 * Set the value of items
	 *
	 * @param array $items
	 *
	 * @return self
	 */
	public function setItems($items) {
        $this->items = $items;
		return $this;
	}

	/**
	 * Get the value of payment
	 *
	 * @return Inspetor\Model\Payment
	 */
	public function getPayment() {
		return $this->payment;
    }

	/**
	 * Set the value of payment
	 *
	 * @param Inspetor\Model\Payment $payment
	 *
	 * @return self
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
			"sale_account_id"         => $this->encodeData($this->getAccountId()),
            "sale_id"                 => $this->encodeData($this->getId()),
            "sale_total_value"        => $this->encodeData($this->getTotalValue()),
            "sale_status"             => $this->encodeData($this->getStatus()),
            "sale_is_fraud"           => $this->encodeData($this->getIsFraud()),
            "sale_creation_timestamp" => $this->encodeData($this->getCreationTimestamp()),
            "sale_update_timestamp"   => $this->encodeData($this->getUpdateTimestamp()),
            "sale_items"              => $this->encodeArray($this->getItems(), true),
            "sale_payement_instance"  => $this->encodeObject($this->getPayment())
        ];

        return $array;
    }
}

?>