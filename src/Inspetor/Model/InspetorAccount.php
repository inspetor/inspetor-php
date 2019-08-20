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

use Inspetor\Exception\ModelException\InspetorAccountException;
use Inspetor\Model\InspetorAddress;
use Inspetor\Model\InspetorAbstractModel;
use JsonSerializable;
use Rhumsaa\Uuid\Console\Exception;

class InspetorAccount extends InspetorAbstractModel implements JsonSerializable {

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
     * @param Inspetor\Model\InspetorAddress $address
     */
    private $address;

    /**
     * @param string $timestamp
     */
    private $timestamp;

    /**
     * @param string $timestamp
     */
    private $password_hash;

    /**
     * Validate Account instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->id) {
            throw new InspetorAccountException(7001);
        }

        if (!$this->email) {
            throw new InspetorAccountException(7002);
        }

        if (!$this->timestamp) {
            throw new InspetorAccountException(7003);
        }

        if (!$this->document) {
            throw new InspetorAccountException(7004);
        }

        if (!$this->phone_number) {
            throw new InspetorAccountException(7005);
        }
    }

    /**
     * Validate Account instance
     *
     * @return void
     */
    public function isValidUpdate() {
        if (!$this->id) {
            throw new InspetorAccountException(7001);
        }

        if (!$this->timestamp) {
            throw new InspetorAccountException(7003);
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
     * @param Inspetor\Model\InspetorAddress $address
     *
     * @return self
     */
    public function setAddress($address) {
        if ($address) {
            $address->isValid();
        }
        $this->address = $address;
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
     * Get the password_hash
     *
     * @return string
     */
    public function getPasswordHash() {
        return $this->password_hash;
    }

    /**
     * Set the value of password_hash
     *
     * @param string  $password_hash
     *
     * @return self
     */
    public function setPasswordHash($password_hash) {
        $this->password_hash = $password_hash;
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
            "account_document"           => $this->encodeData($this->onlyNumbersFormat($this->getDocument())),
            "account_address"            => $this->encodeObject($this->getAddress()),
            "account_timestamp"          => $this->encodeData($this->getTimestamp()),
            "account_phone_number"       => $this->encodeData($this->onlyNumbersFormat($this->getPhoneNumber())),
            "account_password_hash"      => $this->encodeData($this->getPasswordHash()),
        ];

        return $array;
    }
}

?>