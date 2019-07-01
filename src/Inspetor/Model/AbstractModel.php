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

use Inspetor\Exception\ModelException\AbstractException;

class AbstractModel {

    /**
     * encodeArray
     *
     * @param array $array
     * @param boolean $is_object
     * 
     * @return array
     */
    protected function encodeArray(array $array, boolean $is_object) {
        $encoded_array = [];
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
    public function inspetorDateFormatter($time) {
        if (!is_int($time)) {
            if (!((string) (int) $time === $time)
            && ($time <= PHP_INT_MAX)
            && ($time >= ~PHP_INT_MAX)){
                throw new AbsctractException(6901);
            }
        }
        date_default_timezone_set('UTC');
        $formatted = date(DATE_ATOM, $time);

        return $formatted;
    }
}