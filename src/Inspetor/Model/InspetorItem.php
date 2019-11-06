<?php
/**
 * CreditCardInfo
 *
 * PHP version 5
 *
 * @category Class
 * @package  Inspetor\Client
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

use Inspetor\Exception\ModelException\InspetorItemException;
use Inspetor\Model\InspetorAbstractModel;
use JsonSerializable;

class InspetorItem extends InspetorAbstractModel implements JsonSerializable {

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
	private $event_id;

    /**
	 * @param array
	 */
	private $session_ids;

    /**
	 * @param double
	 */
	private $price;

    /**
	 * @param string
	 */
	private $seating_option;

	/**
	 * @param integer
	 */
	private $quantity;

    /**
     * ISVALID
     */

	/**
     * Validate Item instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->id) {
            throw new InspetorItemException(7001);
        }

		if (!$this->event_id) {
            throw new InspetorItemException(7002);
        }

		if (!$this->session_ids || !is_array($this->session_ids) || empty($this->session_ids)) {
            throw new InspetorItemException(7003);
        }

		if (!$this->price) {
            throw new InspetorItemException(7004);
        }

		if (!$this->quantity) {
            throw new InspetorItemException(7006);
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
	 * @param mixed   $id
	 *
	 * @return self
	 */
	public function setId($id) {
        $this->id = $id;
		return $this;
	}

	/**
	 * Get the value of event_id
	 *
	 * @return string
	 */
	public function getEventId() {
		return $this->event_id;
    }

	/**
	 * Set the value of event_id
	 *
	 * @param string  $event_id
	 *
	 * @return self
	 */
	public function setEventId($event_id) {
        $this->event_id = $event_id;
		return $this;
	}

	/**
	 * Get the value of session_ids
	 *
	 *
	 * @return string
	 */
	public function getSessionIds() {
		return $this->session_ids;
    }

	/**
	 * Set the value of session_ids
	 *
	 * @param array  $session_ids
	 *
	 * @return self
	 */
	public function setSessionIds($session_ids) {
        $this->session_ids = $session_ids;
		return $this;
	}

	/**
	 * Get the value of price
	 *
	 * @return double
	 */
	public function getPrice() {
		return $this->price;
    }

	/**
	 * Set the value of price
	 *
	 * @param double $price
	 *
	 * @return self
	 */
	public function setPrice($price) {
		if($price){
			if ($price < 0.0) {
        	    throw new InspetorItemException(7005);
			}
		}

		$this->price = $price;

		return $this;
	}

	/**
	 * Get the value of seating_option
	 *
	 *
	 * @return string
	 */
	public function getSeatingOption() {
		return $this->seating_option;
    }

	/**
	 * Set the value of seating_option
	 *
	 * @param string  $seating_option
	 *
	 * @return self
	 */
	public function setSeatingOption($seating_option) {
        $this->seating_option = $seating_option;
		return $this;
	}

	/**
	 * Get the value of quantity
	 *
	 * @return integer
	 */
	public function getQuantity() {
		return $this->quantity;
    }

	/**
	 * Set the value of quantity
	 *
	 * @param integer  $quantity
	 *
	 * @return self
	 */
	public function setQuantity($quantity) {
		if ($quantity) {
			if ($quantity <= 0) {
				throw new InspetorItemException(7006);
			}
		}
        $this->quantity = $quantity;
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
            "item_id"             => $this->encodeData($this->getId()),
            "item_event_id"       => $this->encodeData($this->getEventId()),
            "item_session_ids"    => $this->encodeArray($this->getSessionIds(), false),
            "item_price"          => $this->encodeData($this->getPrice()),
			"item_seating_option" => $this->encodeData($this->getSeatingOption()),
			"item_quantity"       => $this->encodeData($this->getQuantity())
        ];

        return $array;
    }
}

?>