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

use Inspetor\Exception\ModelException\InspetorSessionException;
use Inspetor\Model\InspetorAbstractModel;
use JsonSerializable;

class InspetorSession extends InspetorAbstractModel implements JsonSerializable {

    /**
     * PROPERTIES
     */

    /**
      * Id of the account that is making the action
      *
      * @param string
    */
    private $id;

    /**
      * Datetime of the event (unix timestamp)
      *
      * @param integer
    */
    private $datetime;

    /**
     * ISVALID
    */

    /**
     * Validate Auth instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->id) {
            throw new InspetorSessionException(7001);
        }

        if (!$this->datetime) {
            throw new InspetorSessionException(7002);
        }
    }

    /**
     * GETTER AND SETTERS
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
     * Get the value of timestamp
     *
     * @return integer
     */
    public function getDatetime() {
        return $this->datetime;
    }

    /**
     * Set the value of timestamp
     *
     * @return self
    */
    public function setDatetime($datetime) {
        $this->datetime = $this->inspetorDateFormatter($datetime);
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
            "session_id"        => $this->encodeData($this->getId()),
            "session_timestamp" => $this->encodeData($this->getDatetime())
        ];

        return $array;
    }

}

?>