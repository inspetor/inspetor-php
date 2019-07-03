<?php

namespace Inspetor\Exception\ModelException;

use Inspetor\Exception\ExceptionAbstract;

class EventException extends ExceptionAbstract {

    /**
     * Category of Exception
     */
    const CATEGORY = 7000;

    /**
     * Description of Exception
     */
    const DESCRIPTION = "Missing parameters and wrong variable values will throw this category of error.";

    /**
     * Header of message
     */
    const HEADER = "INSPETOR EXCEPTION - EVENT";

    /**
     * @var array
     */
    protected static $messages = array(
        1  => "id is a required property. It can't be null.",
        2  => "name is a required property. It can't be null.",
        3  => "update_timestamp is a required property. It can't be null.",
        4  => "producer_id is a required property. It can't be null.",
        5  => "address is a required property. It can't be null.",
        6  => "sessions is a required property. It can't be null neither an empty array.",
        7  => "seating_options is a required property. It can't be null neither an empty array.",
        8  => "categories is a required property. It can't be null neither an empty array.",
        9  => "The status is not a valid one.",
        10 => "sessions should be an array of one or more sessions.",
        11 => "id and timestamp are required properties of a session.",
        12 => "seating_options should be an array."
    );

    /**
     * Construct with fields, to call superclass constructor
     *
     * @param string      $code
     * @param null|string $field
     * @param null        $httpStatus
     */
    function __construct($code, $field = null, $httpStatus = null)
    {

        $fullMessage = $this->getMessageByCode($code, $field, self::HEADER);

        parent::__construct($fullMessage, $httpStatus);
    }
}
