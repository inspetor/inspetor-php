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

use Inspetor\Exception\ModelException\InspetorGeneralException;

class InspetorAbstractModel {

    /**
     * encodeArray
     *
     * @param array $array
     * @param bool $is_object
     *
     * @return array
     */
    protected function encodeArray(?array $array, bool $is_object) {
        $encoded_array = [];
        if(!$array) {
            return null;
        }
        foreach($array as $item) {
            if ($is_object) {
                array_push($encoded_array, $this->encodeObject($item));
            } else {
                array_push($encoded_array, $this->encodeData($item));
            }
        }
        return $encoded_array;
    }

    /**
     * encodeData
     *
     * @param mixed $data
     * @return string
     */
    protected function encodeData($data) {
        if ($data) {
            return base64_encode($data);
        }
        return $data;
    }

    /**
     * encodeObject
     *
     * @param mixed $object
     * @return string
     */
    protected function encodeObject($object) {
        if ($object) {
            return $object->jsonSerialize();
        }
        return $object;
    }

    /**
     * DateTime formatter to Inspetor requirements
     *
     * @param integer $time
     *
     * @return string
    */
    protected function inspetorDateFormatter($time) {
        if (!$time) {
            return null;
        }

        if (!is_int($time)) {
            throw new InspetorGeneralException(7001);
        }

        date_default_timezone_set('UTC');
        $formatted = date(DATE_ATOM, $time);

        return $formatted;
    }

    /**
     * Formatting string to pass only numbers
     *
     * @param string $data
     * @return string
     */
    protected function onlyNumbersFormat($data) {
        if ($data) {
            return preg_replace('/^[0-9]*$/', '', $data);
        }
        return $data;
    }
}