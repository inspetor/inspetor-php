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

class Address implements JsonSerializable {

    /**
     * PROPERTIES
     */
    
    var $street;
    var $number;
    var $zip_code;
    var $city;
    var $state;
    var $country;
    var $latitude;
    var $longitude;

    public function isValid() {
        if ($this->street == null || $this->street == "") {
            throw new Exception("Street can't be null");
        }

        if ($this->number == null || $this->number == "") {
            throw new Exception("Number can't be null");
        }
        
        if ($this->zip_code == null || $this->zip_code == "") {
            throw new Exception("Zip Code can't be null");
        }

        if ($this->city == null || $this->city == "") {
            throw new Exception("City can't be null");
        }

        if ($this->state == null || $this->state == "") {
            throw new Exception("State can't be null");
        }

        if ($this->country == null || $this->country == "") {
            throw new Exception("Country can't be null");
        }
    }

    /**
     * GETTERS AND SETTERS
     */

    /**
     * Get the value of street
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
     * @return  self
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
     * @return  self
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
     * @return  self
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
     * @return  self
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
     * @return  self
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
     * @return  self
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
     * @return  self
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
     * @return  self
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
     * @return array
    */
    public function jsonSerialize() {
        $array = [
            "address_street" => $this->getStreet(),
            "address_number" => $this->getNumber(),
            "address_zip_code" => $this->getZipCode(),
            "address_city" => $this->getCity(),
            "address_state" => $this->getState(),
            "address_country" => $this->getCountry(),
            "address_latitude" => $this->getLatitude(),
            "address_longitude" =>  $this->getLongitude() 
        ];

        return $array;
    }

}

?>