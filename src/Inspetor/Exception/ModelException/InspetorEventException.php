<?php

namespace Inspetor\Exception\ModelException;

use Inspetor\Exception\ExceptionAbstract;

class InspetorEventException extends ExceptionAbstract {

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
        3  => "timestamp is a required property. It can't be null.",
        4  => "creator_id is a required property. It can't be null.",
        5  => "address is a required property when the event has physical place. It can't be null.",
        6  => "sessions is a required property. It can't be null neither an empty array.",
        7  => "seating_options should be null or an array of strings.",
        8  => "categories should be null or an array of strings.",
        9  => "The status is not a valid one.",
        10 => "sessions should be an array of one or more sessions.",
        11 => "id and timestamp are required properties of a session.",
        12 => "admins_id should be an array of one or more users."
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
