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

use Inspetor\Exception\ModelException\InspetorSaleException;
use Inspetor\Model\InspetorItem;
use Inspetor\Model\InspetorPayment;
use Inspetor\Model\InspetorAbstractModel;
use JsonSerializable;

class InspetorSale extends InspetorAbstractModel implements JsonSerializable {

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
	 * @param double
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
     * @param integer
	 */
	private $timestamp;

    /**
	 * @param array
	 */
	private $items;

    /**
	 * @param Inspetor\Model\InspetorPayment
	 */
	private $payment;

	/**
     * Validate Sale instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->id) {
            throw new InspetorSaleException(7001);
        }

		if (!$this->account_id) {
            throw new InspetorSaleException(7002);
        }

		if (!$this->status) {
            throw new InspetorSaleException(7003);
        }

        $this->validateStatus();

		if (!$this->is_fraud) {
            throw new InspetorSaleException(7004);
        }

		if (!$this->timestamp) {
            throw new InspetorSaleException(7005);
        }

		if (!$this->items || empty($this->items)) {
            throw new InspetorSaleException(7006);
        }

		if (!$this->payment) {
            throw new InspetorSaleException(7007);
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
            self::ACCEPTED_STATUS,
            self::DECLINED_STATUS,
            self::PENDING_STATUS,
            self::REFUNDED_STATUS,
            self::MANUAL_ANALYSIS_STATUS,
        ];

        if (!in_array($this->status, $all_status)) {
            throw new InspetorSaleException(7008);
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
                $this->total_value += floatval(
					$item->getPrice()*$item->getQuantity()
				);
            } catch (Exception $e) {
                throw new InspetorSaleException(7009);
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
	 * @return double
	 */
	private function getTotalValue() {
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
	 *
	 * @return integer
	 */
	public function getTimestamp() {
		return $this->timestamp;
    }

	/**
	 * Set the value of timestamp
	 *
	 * @param integer  $timestamp
	 *
	 * @return self
	 */
	public function setTimestamp($timestamp) {
        $this->timestamp = $this->inspetorDateFormatter(
			$timestamp
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
		if ($items) {
			foreach ($items as $item) {
				$item->isValid();
			}
		}
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
	 * @param Inspetor\Model\InspetorPayment $payment
	 *
	 * @return self
	 */
	public function setPayment($payment) {
		if ($payment) {
			$payment->isValid();
		}
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
            "sale_timestamp"  		  => $this->encodeData($this->getTimestamp()),
            "sale_items"              => $this->encodeArray($this->getItems(), true),
            "sale_payment_instance"   => $this->encodeObject($this->getPayment())
        ];

        return $array;
    }
}

?>