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
use JsonSerializable;

class Account implements JsonSerializable {

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
     * @param boolean $debug
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
     * @param boolean $is_editable
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
     * Get the value of name
     *
     * @param boolean $debug
     *
     * @return string
     */
    public function getName($debug = false) {
        if ($debug) {
            return base64_decode($this->name);
        }
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string  $name
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setName($name, $is_editable = true) {
        if ($is_editable) {
            $this->name = base64_encode($name);
        } else {
            $this->name = $name;
        }
        return $this;
    }

    /**
     * Get the value of email
     *
     * @param boolean $debug
     *
     * @return string
     */
    public function getEmail($debug = false) {
        if ($debug) {
            return base64_decode($this->email);
        }
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string  $email
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setEmail($email, $is_editable = true) {
        if ($is_editable) {
            $this->email = base64_encode($email);
        } else {
            $this->email = $email;
        }
        return $this;
    }

    /**
     * Get the value of document
     *
     * @param boolean $debug
     *
     * @return string
     */
    public function getDocument($debug = false) {
        if ($debug) {
            return base64_decode($this->document);
        }
        return $this->document;
    }

    /**
     * Set the value of document
     *
     * @param string  $document
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setDocument($document, $is_editable = true) {
        if ($is_editable) {
            $this->document = base64_encode($document);
        } else {
            $this->document = $document;
        }
        return $this;
    }

    /**
     * Get the value of phone_number
     *
     * @param boolean $debug
     *
     * @return string
     */
    public function getPhoneNumber($debug = false) {
        if ($debug) {
            return base64_decode($this->phone_number);
        }
        return $this->phone_number;
    }

    /**
     * Set the value of phone_number
     *
     * @param string  $phone_number
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setPhoneNumber($phone_number, $is_editable = true) {
        if ($is_editable) {
            $this->phone_number = base64_encode($phone_number);
        } else {
            $this->phone_number = $phone_number;
        }
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
     * @param string $update_timestamp
     *
     * @return self
     */
    public function setUpdateTimestamp($update_timestamp) {
        $this->update_timestamp = $update_timestamp;
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
     * @param string $update_timestamp
     *
     * @return self
     */
    public function setCreationTimestamp($creation_timestamp) {
        $this->create_function = $creation_timestamp;
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
            "account_id"               => $this->getId(),
            "account_name"             => $this->getName(),
            "account_email"            => $this->getEmail(),
            "account_document"         => $this->getDocument(),
            "account_address"          => $this->getAddress()->jsonSerialize(),
            "account_billing_address"  => $this->getBillingAddress()->jsonSerialize(),
            "account_create_timestamp" => $this->getCreationTimestamp(),
            "account_update_timestamp" => $this->getUpdateTimestamp(),
            "account_phone_number"     => $this->getPhoneNumber()
        ];

        return $array;
    }
}

?>