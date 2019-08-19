<?php

/**
 * Auth
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

use Inspetor\Exception\ModelException\InspetorAuthException;
use Inspetor\Model\InspetorAbstractModel;
use JsonSerializable;

class InspetorAuth extends InspetorAbstractModel implements JsonSerializable {

    const ACCOUNT_LOGIN_ACTION  = "account_login";
    const ACCOUNT_LOGOUT_ACTION = "account_logout";

    /**
     * PROPERTIES
     */

    /**
      * Email of the account that is making the action
      *
      * @var string
    */
    private $account_email;

    /**
      * Time and date when the action is occured.
      * The format needs to be in DD-MM-YYYY HH:MI:SS
      *
      * @var integer
    */
    private $timestamp;

    /**
     * If the attemp to login succeeded, it should have an account_id
     *
     * @var boolean
     */
    private $account_id;

    /**
     * ISVALID
    */

    /**
     * Validate Auth instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->account_email) {
            throw new InspetorAuthException(7001);
        }

        if (!$this->timestamp) {
            throw new InspetorAuthException(7002);
        }
    }

    /**
     * GETTER AND SETTERS
    */

    /**
     * Get the value of account_email
     *
     * @return string
    */
    public function getAccountEmail() {
        return $this->account_email;
    }

    /**
     * Set the value of account_email
     *
     * @param string  $account_email
     *
     * @return self
    */
    public function setAccountEmail($account_email) {
        $this->account_email = $account_email;
        return $this;
    }

    /**
     * Get the value of timestamp
     *
     * @return integer
     */
    public function getTimestamp() {
        return $this->timestamp;
    }

    /**
     * Set the value of timestamp
     *
     * @param integer $timestamp
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
	 * Return account id if login was successful, empty string if not.
	 *
	 * @return  string
	 */
	public function getAccountId() {
		return $this->account_id;
    }

	/**
	 * Set if the attemp to login was account_id or not
	 *
	 * @param   string  $account_id if login was successful, pass id
	 *
	 * @return  self
	 */
	public function setAccountId($account_id = null) {
        $this->account_id = $account_id;
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
            "auth_account_email" => $this->encodeData($this->getAccountEmail()),
            "auth_timestamp"     => $this->encodeData($this->getTimestamp()),
            "auth_account_id"     => $this->encodeData($this->getAccountId()),
        ];

        return $array;
    }
}

?>