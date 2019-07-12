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

use Inspetor\Exception\ModelException\InspetorAddressException;
use Inspetor\Model\InspetorAbstractModel;
use JsonSerializable;

class InspetorAddress extends InspetorAbstractModel implements JsonSerializable {

    /**
     * PROPERTIES
     */

    /**
     * @param string
     */
    private $street;

    /**
     * @param string
     */
    private $number;

    /**
     * @param string
     */
    private $zip_code;

    /**
     * @param string
     */
    private $city;

    /**
     * @param string
     */
    private $state;

    /**
     * @param string
     */
    private $country;

    /**
     * @param string
     */
    private $latitude;

    /**
     * @param string
     */
    private $longitude;

    /**
     * Validate Account instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->street) {
            throw new InspetorAddressException(7001);
        }

        if (!$this->zip_code) {
            throw new InspetorAddressException(7002);
        }

        if (!$this->city) {
            throw new InspetorAddressException(7003);
        }

        if (!$this->state) {
            throw new InspetorAddressException(7004);
        }

        if (!$this->country) {
            throw new InspetorAddressException(7005);
        }
    }

    /**
     * GETTERS AND SETTERS
     */

    /**
     * Get the value of street
     *
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Set the value of street
     *
     * @param string  $street
     *
     * @return self
     */
    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    /**
     * Get the value of number
     *
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @param string  $number
     *
     * @return self
     */
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    /**
     * Get the value of zip_code
     *
     */
    public function getZipCode() {
        return $this->zip_code;
    }

    /**
     * Set the value of zip_code
     *
     * @param string  $zip_code
     *
     * @return self
     */
    public function setZipCode($zip_code) {
        $this->zip_code = $zip_code;
        return $this;
    }

    /**
     * Get the value of city
     *
     *
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @param string  $city
     *
     * @return self
     */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    /**
     * Get the value of state
     *
     *
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @param string  $state
     *
     * @return self
     */
    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    /**
     * Get the value of country
     *
     *
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @param string  $country
     *
     * @return self
     */
    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    /**
     * Get the value of latitude
     *
     *
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * Set the value of latitude
     *
     * @param string  $latitude
     *
     * @return self
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * Get the value of longitude
     *
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * Set the value of longitude
     *
     * @param string  $longitude
     *
     * @return self
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * JSONSERIALIZE
    */

    /**
     * Create a json with the data from the object
     *
     * @return array
    */
    public function jsonSerialize() {
        $array = [
            "address_street"    => $this->encodeData($this->getStreet()),
            "address_number"    => $this->encodeData($this->getNumber()),
            "address_zip_code"  => $this->encodeData($this->getZipCode()),
            "address_city"      => $this->encodeData($this->getCity()),
            "address_state"     => $this->encodeData($this->getState()),
            "address_country"   => $this->encodeData($this->getCountry()),
            "address_latitude"  => $this->encodeData($this->getLatitude()),
            "address_longitude" => $this->encodeData($this->getLongitude())
        ];

        return $array;
    }

}

?>