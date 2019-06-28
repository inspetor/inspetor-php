<?php

namespace Inspetor\Inspetor\Exception\ModelException;

use Inspetor\Inspetor\Exception\ExceptionAbstract;

class EventException extends ExceptionAbstract {

    /**
     * Category of Exception
     */
    const CATEGORY = 7500;

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
        1 => "id is a required property. It can't be null.",
        2 => "creation_timestamp is a required property. It can't be null.",
        3 => "name is a required property. It can't be null.",
        4 => "update_timestamp is a required property. It can't be null.",
        5 => "producer_id is a required property. It can't be null.",
        6 => "address is a required property. It can't be null.",
        7 => "sessions is a required property. It can't be null neither an empty array.",
        8 => "seating_options is a required property. It can't be null neither an empty array.",
        9 => "categories is a required property. It can't be null neither an empty array.",
        10 => "The status is not a valid one."
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
