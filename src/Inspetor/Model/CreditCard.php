<?php
/**
 * CreditCardInfo
 *
 * PHP version 5
 *
 * @category Class
 * @package  Inspetor\Client
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

class CreditCard implements JsonSerializable {

    /**
     * PROPERTIES
     */
    var $first_six_digits;
    var $last_four_digits;
    var $holder_name;
    var $holder_cpf;

    /**
     * ISVALID
     */

    public function isValid() {
        if ($this->first_six_digits == null || $this->first_six_digits == "") {
            throw new Exception("The first six digits can't be null");
        }

        if ($this->last_four_digits == null || $this->last_four_digits == "") {
            throw new Exception("The last four digits can't be null");
        }

        if ($this->holder_name== null || $this->holder_name == "") {
            throw new Exception("The holder name can't be null");
        }

        if ($this->holder_cpf == null || $this->holder_cpf == "") {
            throw new Exception("The holder cpf can't be null");
        }
    }

    /**
     * GETTERS AND SETTERS
     */


    /**
     * Get pROPERTIES
     */ 
    public function getFirstSixDigits($debug = false) {
        if ($debug) {
            return base64_decode($this->first_six_digits);
        }
        return $this->first_six_digits;
    }

    /**
     * Set pROPERTIES
     *
     * @return  self
     */ 
    public function setFirstSixDigits($first_six_digits, $is_editable = true) {
        if ($is_editable) {
            $this->first_six_digits = base64_encode($first_six_digits);
        } else {
            $this->first_six_digits = $first_six_digits;
        }
        return $this;
    }

    /**
     * Get the value of last_four_digits
     */ 
    public function getLastFourDigits($debug = false) {
        if ($debug) {
            return base64_decode($this->last_four_digits);
        }
        return $this->last_four_digits;
    }

    /**
     * Set the value of last_four_digits
     *
     * @return  self
     */ 
    public function setLastFourDigits($last_four_digits, $is_editable = true) {
        if ($is_editable) {
            $this->last_four_digits = base64_encode($last_four_digits);
        } else {
            $this->last_four_digits = $last_four_digits;
        }
        return $this;
    }

    /**
     * Get the value of holder_name
     */ 
    public function getHolderName($debug = false) {
        if ($debug) {
            return base64_decode($this->holder_name);
        }
        return $this->holder_name;
    }

    /**
     * Set the value of holder_name
     *
     * @return  self
     */ 
    public function setHolderName($holder_name, $is_editable = true) {
        if ($is_editable) {
            $this->holder_name = base64_encode($holder_name);
        } else {
            $this->holder_name = $holder_name;
        }
        return $this;
    }

    /**
     * Get the value of holder_cpf
     */ 
    public function getHolderCpf($debug = false) {
        if ($debug) {
            return base64_decode($this->holder_cpf);
        }
        return $this->holder_cpf;
    }

    /**
     * Set the value of holder_cpf
     *
     * @return  self
     */ 
    public function setHolderCpf($holder_cpf, $is_editable = true) {
        if ($is_editable) {
            $this->holder_cpf = base64_encode($holder_cpf);
        } else {
            $this->holder_cpf = $holder_cpf;
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
            "cc_first_six" => $this->getFirstSixDigits(),
            "cc_last_four" => $this->getLastFourDigits(),
            "cc_holder_name" => $this->getHolderName(),
            "cc_holder_cpf" => $this->getHolderCpf()
        ];

        return $array;
    }

}


?>