<?php

namespace Inspetor\Exception\ModelException;

use Inspetor\Exception\ExceptionAbstract;

class SaleException extends ExceptionAbstract {

    /**
     * Category of Exception
     */
    const CATEGORY = 7900;

    /**
     * Description of Exception
     */
    const DESCRIPTION = "Missing parameters and wrong variable values will throw this category of error.";

    /**
     * Header of message
     */
    const HEADER = "INSPETOR EXCEPTION - ACCOUNT";

    /**
     * @var array
     */
    protected static $messages = array(
        1  => "id is a required property. It can't be null.",
        2  => "account_id is a required property. It can't be null.",
        3  => "status is a required property. It can't be null.",
        4  => "is_fraud is a required property. It can't be null.",
        5  => "creation_timestamp is a required property. It can't be null.",
        6  => "update_timestamp is a required property. It can't be null.",
        7  => "items is a required property. It can't be null neither an empty array.",
        8  => "payment is a required property. It can't be null.",
        9  => "The status is not a valid one.",
        10 => "One or more items have invalid price."
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
