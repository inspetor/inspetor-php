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

class PassRecovery implements JsonSerializable {

    const PASSWORD_RESET_ACTION = "password_reset";
    const PASSWORD_RECOVERY_ACTION = "password_recovery";

    /**
     * PROPERTIES
     */

    var $recovery_email;
    var $timestamp;

    /**
     * ISVALID
     */

    public function isValid() {
        if ($this->recovery_email == null || $this->recovery_email == "") {
            throw new Exception("Recovery email can't be null");
        }
        if ($this->timestamp == null || $this->timestamp == "") {
            throw new Exception("Timestamp can't be null");
        }
    }

    /**
     * GETTER AND SETTER
     */

	/**
	 * Get the value of recovery_email
	 * 
	 * @param   boolean $debug  If set as true will decode the value
	 *
	 * @return  mixed
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
	 * @param   mixed  $recovery_email  
	 * @param   boolean $is_editable  If set as true will encode the value
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