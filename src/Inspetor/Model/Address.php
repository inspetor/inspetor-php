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

use Inspetor\Exception\AddressException;

class Address implements JsonSerializable {

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
            throw new AddressException(7101);
        }

        if (!$this->number) {
            throw new AddressException(7102);
        }

        if (!$this->zip_code) {
            throw new AddressException(7103);
        }

        if (!$this->city) {
            throw new AddressException(7104);
        }

        if (!$this->state) {
            throw new AddressException(7105);
        }

        if (!$this->country) {
            throw new AddressException(7106);
        }
    }

    /**
     * GETTERS AND SETTERS
     */

    /**
     * Get the value of street
     *
     * @param boolean $debug
     *
     */
    public function getStreet($debug = false) {
        if ($debug) {
            return base64_decode($this->street);
        }
        return $this->street;
    }

    /**
     * Set the value of street
     *
     * @param string  $street
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setStreet($street, $is_editable = true) {
        if ($is_editable) {
            $this->street = base64_encode($street);
        } else {
            $this->street = $street;
        }
        return $this;
    }

    /**
     * Get the value of number
     *
     * @param boolean $debug
     *
     */
    public function getNumber($debug = false) {
        if ($debug) {
            return base64_decode($this->number);
        }
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @param string  $number
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setNumber($number, $is_editable = true) {
        if ($is_editable) {
            $this->number = base64_encode($number);
        } else {
            $this->number = $number;
        }
        return $this;
    }

    /**
     * Get the value of zip_code
     *
     * @param boolean $debug
     *
     */
    public function getZipCode($debug = false) {
        if ($debug) {
            return base64_decode($this->zip_code);
        }
        return $this->zip_code;
    }

    /**
     * Set the value of zip_code
     *
     * @param string  $zip_code
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setZipCode($zip_code, $is_editable = true) {
        if ($is_editable) {
            $this->zip_code = base64_encode($zip_code);
        } else {
            $this->zip_code = $zip_code;
        }
        return $this;
    }

    /**
     * Get the value of city
     *
     * @param boolean $debug
     *
     */
    public function getCity($debug = false) {
        if ($debug) {
            return base64_decode($this->city);
        }
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @param string  $city
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setCity($city, $is_editable = true) {
        if ($is_editable) {
            $this->city = base64_encode($city);
        } else {
            $this->city = $city;
        }
        return $this;
    }

    /**
     * Get the value of state
     *
     * @param boolean $debug
     *
     */
    public function getState($debug = false) {
        if ($debug) {
            return base64_decode($this->state);
        }
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @param string  $state
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setState($state, $is_editable = true) {
        if ($is_editable) {
            $this->state = base64_encode($state);
        } else {
            $this->state = $state;
        }
        return $this;
    }

    /**
     * Get the value of country
     *
     * @param boolean $debug
     *
     */
    public function getCountry($debug = false) {
        if ($debug) {
            return base64_decode($this->country);
        }
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @param string  $country
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setCountry($country, $is_editable = true) {
        if ($is_editable) {
            $this->country = base64_encode($country);
        } else {
            $this->country = $country;
        }
        return $this;
    }

    /**
     * Get the value of latitude
     *
     * @param boolean $debug
     *
     */
    public function getLatitude($debug = false) {
        if ($debug) {
            return base64_decode($this->latitude);
        }
        return $this->latitude;
    }

    /**
     * Set the value of latitude
     *
     * @param string  $latitude
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setLatitude($latitude, $is_editable = true) {
        if ($is_editable) {
            $this->latitude = base64_encode($latitude);
        } else {
            $this->latitude = $latitude;
        }
        return $this;
    }

    /**
     * Get the value of longitude
     *
     * @param boolean $debug
     *
     */
    public function getLongitude($debug = false) {
        if ($debug) {
            return base64_decode($this->longitude);
        }
        return $this->longitude;
    }

    /**
     * Set the value of longitude
     *
     * @param string  $longitude
     * @param boolean $is_editable
     *
     * @return self
     */
    public function setLongitude($longitude, $is_editable = true) {
        if ($is_editable) {
            $this->longitude = base64_encode($longitude);
        } else {
            $this->longitude = $longitude;
        }
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
            "address_street"    => $this->getStreet(),
            "address_number"    => $this->getNumber(),
            "address_zip_code"  => $this->getZipCode(),
            "address_city"      => $this->getCity(),
            "address_state"     => $this->getState(),
            "address_country"   => $this->getCountry(),
            "address_latitude"  => $this->getLatitude(),
            "address_longitude" => $this->getLongitude()
        ];

        return $array;
    }

}

?>