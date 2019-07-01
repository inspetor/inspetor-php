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

use Inspetor\Exception\ModelException\ItemException;
use JsonSerializable;

class Item implements JsonSerializable {

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
	 * @param string
	 */
	private $session_id;

    /**
	 * @param string
	 */
	private $price;

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
        if (!$this->id) {
            throw new ItemException(7601);
        }
        if (!$this->event_id) {
            throw new ItemException(7602);
        }
        if (!$this->session_id) {
            throw new ItemException(7603);
        }
        if (!$this->price) {
            throw new ItemException(7604);
        }
        if (!$this->seating_option) {
            throw new ItemException(7605);
        }
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
	 * @param mixed   $id
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
	 * Get the value of event_id
	 *
	 * @param boolean $debug  If set as true will decode the value
	 *
	 * @return string
	 */
	public function getEventId($debug = false) {
        if ($debug) {
            return base64_decode($this->event_id);
        }
		return $this->event_id;
    }

	/**
	 * Set the value of event_id
	 *
	 * @param string  $event_id
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setEventId($event_id, $is_editable = false) {
        if ($is_editable) {
            $this->event_id = base64_encode($event_id);
        } else {
            $this->event_id = $event_id;
        }
		return $this;
	}

	/**
	 * Get the value of session_id
	 *
	 * @param boolean $debug  If set as true will decode the value
	 *
	 * @return string
	 */
	public function getSessionId($debug = false) {
        if ($debug) {
            return base64_decode($this->session_id);
        }
		return $this->session_id;
    }

	/**
	 * Set the value of session_id
	 *
	 * @param string  $session_id
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setSessionId($session_id, $is_editable = true) {
        if ($is_editable) {
            $this->session_id = base64_encode($session_id);
        } else {
            $this->session_id = $session_id;
        }
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
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setPrice($price) {
		$price = $this->convertToValidPrice($price);

		if (!$price) {
            throw new ItemException(7606);
		}

		$this->price = $price;

		return $this;
	}

	/**
	 * Get the value of seating_option
	 *
	 * @param boolean $debug  If set as true will decode the value
	 *
	 * @return string
	 */
	public function getSeatingOption($debug = false) {
        if ($debug) {
            return base64_decode($this->seating_option);
        }
		return $this->seating_option;
    }

	/**
	 * Set the value of seating_option
	 *
	 * @param string  $seating_option
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setSeatingOption($seating_option, $is_editable = true) {
        if ($is_editable) {
            $this->seating_option = base64_encode($seating_option);
        } else {
            $this->seating_option = $seating_option;
        }
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
            "item_id" => $this->getId(),
            "item_event_id" => $this->getEventId(),
            "item_session_id" => $this->getSessionId(),
            "item_price" => $this->getPrice(),
            "item_seating_option" => $this->getSeatingOption()
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