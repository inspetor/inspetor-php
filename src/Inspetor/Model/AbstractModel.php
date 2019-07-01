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
     * @return array
     */
    protected function encodeArray(array $array) {
        $encoded_array = [];
        foreach($array as $item) {
            array_push($encoded_array, base64_encode($item));
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