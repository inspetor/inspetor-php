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

use Inspetor\Exception\ModelException\PassRecoveryException;
use Inspetor\Model\AbstractModel;
use JsonSerializable;

class PassRecovery extends AbstractModel implements JsonSerializable {

    const PASSWORD_RESET_ACTION    = "password_reset";
    const PASSWORD_RECOVERY_ACTION = "password_recovery";

    /**
     * PROPERTIES
     */

    /**
     * @param string
     */
    private $recovery_email;

    /**
     * @param string
     */
    private $timestamp;


    /**
     * ISVALID
     */

    /**
     * Validate PassRecovery instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->recovery_email) {
            throw new PassRecoveryException(7701);
        }
        if (!$this->timestamp) {
            throw new PassRecoveryException(7702);
        }
    }

    /**
     * GETTER AND SETTER
     */

	/**
	 * Get the value of recovery_email
	 *
	 * @param boolean $debug  If set as true will decode the value
	 *
	 * @return string
	 */
	public function getRecoveryEmail($debug = false) {
        if ($debug) {
            return base64_decode($this->recovery_email);
        }
		return $this->recovery_email;
    }

	/**
	 * Set the value of recovery_email
	 *
	 * @param string  $recovery_email
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return  self
	 */
	public function setRecoveryEmail($recovery_email, $is_editable = true) {
        if ($is_editable) {
            $this->recovery_email = base64_encode($recovery_email);
        } else {
            $this->recovery_email = $recovery_email;
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
	 * @return  self
	 */
	public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
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
            "pass_recovery_email" => $this->getRecoveryEmail(),
            "pass_recovery_timestamp" => $this->getTimestamp()
        ];

        return $array;
    }

}


?>