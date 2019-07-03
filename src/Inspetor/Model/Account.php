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

use Inspetor\Exception\ModelException\AccountException;
use Inspetor\Model\Address;
use Inspetor\Model\AbstractModel;
use JsonSerializable;
use Rhumsaa\Uuid\Console\Exception;

class Account extends AbstractModel implements JsonSerializable {

    const ACCOUNT_CREATE_ACTION = "account_create";
    const ACCOUNT_UPDATE_ACTION = "account_update";
    const ACCOUNT_DELETE_ACTION = "account_delete";

    /**
     * PROPERTIES
    */

    /**
     * @param string $id
     */
    private $id;

    /**
     * @param string $name
     */
    private $name;

    /**
     * @param string $email
     */
    private $email;

    /**
     * @param string $document
     */
    private $document;

    /**
     * @param string $phone_number
     */
    private $phone_number;

    /**
     * @param Inspetor\Model\Address $address
     */
    private $address;

    /**
     * @param Inspetor\Model\Address $billing_address
     */
    private $billing_address;

    /**
     * @param string $creation_timestamp
     */
    private $creation_timestamp;

    /**
     * @param string $update_timestamp
     */
    private $update_timestamp;

    /**
     * Validate Account instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->id) {
            throw new AccountException(7001);
        }

        if (!$this->email) {
            throw new AccountException(7002);
        }

        if (!$this->update_timestamp) {
            throw new AccountException(7003);
        }
    }

    /**
     * GETTERS AND SETTERS
    */

    /**
     * Get the value of id
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
     * Get the value of name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string  $name
     *
     * @return self
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string  $email
     *
     * @return self
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of document
     *
     * @return string
     */
    public function getDocument() {
        return $this->document;
    }

    /**
     * Set the value of document
     *
     * @param string  $document
     *
     * @return self
     */
    public function setDocument($document) {
        $this->document = $document;
        return $this;
    }

    /**
     * Get the value of phone_number
     *
     * @return string
     */
    public function getPhoneNumber() {
        return $this->phone_number;
    }

    /**
     * Set the value of phone_number
     *
     * @param string  $phone_number
     *
     * @return self
     */
    public function setPhoneNumber($phone_number) {
        $this->phone_number = $phone_number;
        return $this;
    }

    /**
     * Get the value of address
     *
     * @return Inspetor\Model\Address
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param Inspetor\Model\Address $address
     *
     * @return self
     */
    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    /**
     * Get the value of billing_address
     *
     * @return Inspetor\Model\Address
     */
    public function getBillingAddress() {
        return $this->billing_address;
    }

    /**
     * Set the value of billing_address
     *
     * @param Inspetor\Model\Address $billing_address
     *
     * @return self
     */
    public function setBillingAddress($billing_address) {
        $this->billing_address = $billing_address;
        return $this;
    }

    /**
     * Get the value of update_timestamp
     *
     * @return string
     */
    public function getUpdateTimestamp() {
        return $this->update_timestamp;
    }

    /**
     * Set the value of update_timestamp
     *
     * @param integer $update_timestamp
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
     * Get the value of creation_timestamp
     *
     * @return string
     */
    public function getCreationTimestamp() {
        return $this->creation_timestamp;
    }

    /**
     * Set the value of creation_timestamp
     *
     * @param integer $update_timestamp
     *
     * @return self
     */
    public function setCreationTimestamp($creation_timestamp) {
        $this->create_function = $this->inspetorDateFormatter(
            $creation_timestamp
        );
        return $this;
    }

    /**
     * JSONSERIALIZE
    */

    /**
     * Create a json with the data from the object
     *
     *  @return array
    */
    public function jsonSerialize() {
        $array = [
            "account_id"                 => $this->encodeData($this->getId()),
            "account_name"               => $this->encodeData($this->getName()),
            "account_email"              => $this->encodeData($this->getEmail()),
            "account_document"           => $this->encodeData($this->getDocument()),
            "account_address"            => $this->encodeObject($this->getAddress()),
            "account_billing_address"    => $this->encodeObject($this->getBillingAddress()),
            "account_creation_timestamp" => $this->encodeData($this->getCreationTimestamp()),
            "account_update_timestamp"   => $this->encodeData($this->getUpdateTimestamp()),
            "account_phone_number"       => $this->encodeData($this->getPhoneNumber())
        ];

        return $array;
    }
}

?>