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

use Inspetor\Exception\ModelException\InspetorCategoryException;
use Inspetor\Model\InspetorAbstractModel;
use JsonSerializable;

class InspetorCategory extends InspetorAbstractModel implements JsonSerializable {

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
      * Time and date when the action is occured.
      * The format needs to be in DD-MM-YYYY HH:MI:SS
      *
      * @param string
    */
    private $name;

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
            throw new InspetorCategoryException(7001);
        }

        if (!$this->name) {
            throw new InspetorCategoryException(7002);
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
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set the value of timestamp
     *
     * @return self
    */
    public function setName($name) {
        $this->name = $name;
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
            "category_id"   => $this->encodeData($this->getId()),
            "category_name" => $this->encodeData($this->getName())
        ];

        return $array;
    }

}

?>