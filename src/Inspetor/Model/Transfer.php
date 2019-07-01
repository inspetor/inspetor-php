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

use Inspetor\Exception\ModelException\TransferException;
use Inspetor\Model\AbstractModel;
use JsonSerializable;

class Transfer extends AbstractModel implements JsonSerializable {

    const TRANSFER_CREATE_ACTION        = "transfer_create";
    const TRANSFER_UPDATE_STATUS_ACTION = "transfer_update_status";

    const ACCEPTED_STATUS = "accepted";
    const REJECTED_STATUS = "rejected";
    const PENDING_STATUS  = "pending";

    /**
     * PROPERTIES
     */

    var $id;
    var $timestamp;
    var $item_id;
    var $sender_account_id;
    var $receiver_email;
    var $status;

    /**
     * ISVALID
     */

	/**
     * Validate Transfer instance
     *
     * @return void
     */
    public function isValid () {
        if (!$this->id == null) {
            throw new TransferException(8001);
        }
        if (!$this->timestamp) {
            throw new TransferException(8002);
        }
        if (!$this->item_id) {
            throw new TransferException(8003);
        }
        if (!$this->sender_account_id) {
            throw new TransferException(8004);
        }
        if (!$this->receiver_email) {
            throw new TransferException(8005);
        }
        $this->validateStatus();
    }

	/**
	 * Validate status of the event
	 *
	 * @return void
	 */
    private function validateStatus() {
        $all_status = [
            self::ACCEPTED,
            self::PENDING,
            self::REJECTED,
        ];

        if (!in_array($this->status, $all_status)) {
            throw new TransferException(8006);
        }
    }

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
	 * Get the value of timestamp
	 *
	 * @param boolean $debug  If set as true will decode the value
	 *
	 * @return string
	 */
	public function getTimestamp() {
		return $this->timestamp;
    }

	/**
	 * Set the value of timestamp
	 *
	 * @param string  $timestamp
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setTimestamp($timestamp, $is_editable = true) {
        $this->timestamp = $timestamp;
		return $this;
	}

	/**
	 * Get the value of item_id
	 *
	 * @param boolean $debug  If set as true will decode the value
	 *
	 * @return string
	 */
	public function getItemId($debug = false) {
        if ($debug) {
            return base64_decode($this->item_id);
        }
		return $this->item_id;
    }

	/**
	 * Set the value of item_id
	 *
	 * @param string  $item_id
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setItemId($item_id, $is_editable = false) {
        if ($is_editable) {
            $this->item_id = base64_encode($item_id);
        } else {
            $this->item_id = $item_id;
        }
		return $this;
	}

	/**
	 * Get the value of sender_account_id
	 *
	 * @param boolean $debug  If set as true will decode the value
	 *
	 * @return string
	 */
	public function getSenderAccountId($debug = false) {
        if ($debug) {
            return base64_decode($this->sender_account_id);
        }
		return $this->sender_account_id;
    }

	/**
	 * Set the value of sender_account_id
	 *
	 * @param string  $sender_account_id
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setSenderAccountId($sender_account_id, $is_editable = false) {
        if ($is_editable) {
            $this->sender_account_id = base64_encode($sender_account_id);
        } else {
            $this->sender_account_id = $sender_account_id;
        }
		return $this;
	}

	/**
	 * Get the value of receiver_email
	 *
	 * @param boolean $debug  If set as true will decode the value
	 *
	 * @return string
	 */
	public function getReceiverEmail($debug = false) {
        if ($debug) {
            return base64_decode($this->receiver_email);
        }
		return $this->receiver_email;
    }

	/**
	 * Set the value of receiver_email
	 *
	 * @param string  $receiver_email
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setReceiverEmail($receiver_email, $is_editable = true) {
        if ($is_editable) {
            $this->receiver_email = base64_encode($receiver_email);
        } else {
            $this->receiver_email = $receiver_email;
        }
		return $this;
	}

	/**
	 * Get the value of status
	 *
	 * @param boolean $debug  If set as true will decode the value
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
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setStatus($status, $is_editable = true) {
        $this->status = $status;
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
            "transfer_id"                => $this->getId(),
            "transfer_timestamp"         => $this->getTimestamp(),
            "transfer_item_id"           => $this->getItemId(),
            "transfer_sender_account_id" => $this->getSenderAccountId(),
            "transfer_receiver_email"    => $this->getReceiverEmail(),
            "transfer_status"            => $this->getStatus()
        ];

        return $array;
    }


}

?>