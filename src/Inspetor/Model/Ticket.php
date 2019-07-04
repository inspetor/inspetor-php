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

use Inspetor\Exception\ModelException\TicketException;
use Inspetor\Model\AbstractModel;
use JsonSerializable;

class Tickets extends Item implements JsonSerializable {

    /**
     * PROPERTIES
     */

    /**
	 * @param string
	 */
	private $event_id;

    /**
	 * @param string
	 */
	private $session_id;

    /**
	 * @param string
	 */
	private $seating_option;


    /**
     * ISVALID
     */

	/**
     * Validate Item instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->event_id) {
            throw new TicketException(7002);
		}

        if (!$this->session_id) {
            throw new TicketException(7003);
		}

        if (!$this->seating_option) {
            throw new TicketException(7005);
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
	 * Get the value of session_id
	 *
	 *
	 * @return string
	 */
	public function getSessionId() {
		return $this->session_id;
    }

	/**
	 * Set the value of session_id
	 *
	 * @param string  $session_id
	 *
	 * @return self
	 */
	public function setSessionId($session_id) {
        $this->session_id = $session_id;
		return $this;
	}

	/**
	 * Get the value of price
	 *
	 * @return string
	 */
	public function getPrice() {
		return $this->price;
    }

	/**
	 * Set the value of price
	 *
	 * @param string  $price
	 *
	 * @return self
	 */
	public function setPrice($price) {
		$price = $this->convertToValidPrice($price);

		if (!$price) {
            throw new TicketException(7006);
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
            "item_session_id"     => $this->encodeData($this->getSessionId()),
            "item_price"          => $this->encodeData($this->getPrice()),
            "item_seating_option" => $this->encodeData($this->getSeatingOption())
        ];

        return $array;
    }

	/**
	 * Convert $price string to valid value
	 *
	 * @param string $price
	 *
	 * @return
	 */
	private function convertToValidPrice($price) {
		$price = str_replace(['-', ',', '$', ' '], '', $price);
		if(!is_numeric($price)) {
			$price = null;
		} else {
			if(strpos($price, '.') !== false) {
				$dollarExplode = explode('.', $price);
				$dollar = $dollarExplode[0];
				$cents = $dollarExplode[1];
				if(strlen($cents) === 0) {
					$cents = '00';
				} elseif(strlen($cents) === 1) {
					$cents = $cents.'0';
				} elseif(strlen($cents) > 2) {
					$cents = substr($cents, 0, 2);
				}
				$price = $dollar.'.'.$cents;
			} else {
				$cents = '00';
				$price = $price.'.'.$cents;
			}
		}

		return $price;
	}
}

?>