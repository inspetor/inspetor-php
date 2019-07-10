<?php

namespace Inspetor\Exception\ModelException;

use Inspetor\Exception\ExceptionAbstract;

class ItemException extends ExceptionAbstract {

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
    const HEADER = "INSPETOR EXCEPTION - ITEM";

    /**
     * @var array
     */
    protected static $messages = array(
        1 => "id is a required property. It can't be null.",
        2 => "event_id is a required property. It can't be null.",
        3 => "session_id is a required property. It can't be null.",
        4 => "price is a required property. It can't be null.",
        5 => "seating_option is a required property. It can't be null.",
        6 => "price is not valid. It must be a double value equals or greater than zero.",
        7 => "quantity is a required property. It must be an integer greater than zero."
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
