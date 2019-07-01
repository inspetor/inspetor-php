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

use Inspetor\Exception\ModelException\AuthException;
use Inspetor\Model\AbstractModel;
use JsonSerializable;

class Auth extends AbstractModel implements JsonSerializable {

    const ACCOUNT_LOGIN_ACTION  = "account_login";
    const ACCOUNT_LOGOUT_ACTION = "account_logout";

    /**
     * PROPERTIES
     */

    /**
      * Id of the account that is making the action
      *
      * @param string
    */
    private $account_id;

    /**
      * Email of the account that is making the action
      *
      * @param string
      */
    private $account_email;

    /**
      * Time and date when the action is occured.
      * The format needs to be in DD-MM-YYYY HH:MI:SS
      *
      * @param string
    */
    private $timestamp;

    /**
     * ISVALID
    */

    /**
     * Validate Auth instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->account_id) {
            throw new AuthException(7201);
        }

        if (!$this->timestamp) {
            throw new AuthException(7202);
        }
    }

    /**
     * GETTER AND SETTERS
    */

    /**
     * Get the value of account_id
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
     * Get the value of account_email
     *
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
     * @return string
     */
    public function getTimestamp() {
        return $this->timestamp;
    }

    /**
     * Set the value of timestamp
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
     * JSONSERIALIZE
    */

    /**
     * Create a json with the data from the object
     * @return array
    */
    public function jsonSerialize() {
        $array = [
            "auth_account_id"    => $this->encodeData($this->getAccountId()),
            "auth_account_email" => $this->encodeData($this->getAccountEmail()),
            "auth_timestamp"     => $this->encodeData($this->getTimestamp())
        ];

        return $array;
    }

}

?>