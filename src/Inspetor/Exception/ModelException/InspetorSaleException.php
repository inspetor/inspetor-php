<?php

namespace Inspetor\Exception\ModelException;

use Inspetor\Exception\ExceptionAbstract;

class InspetorSaleException extends ExceptionAbstract {

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
    const HEADER = "INSPETOR EXCEPTION - ACCOUNT";

    /**
     * @var array
     */
    protected static $messages = array(
        1  => "id is a required property. It can't be null.",
        2  => "account_id is a required property. It can't be null on creation.",
        3  => "status is a required property. It can't be null on creation.",
        4  => "is_fraud is a required property. It can't be null on creation.",
        5  => "timestamp is a required property. It can't be null.",
        6  => "items is a required property. It can't be null neither an empty array on creation.",
        7  => "payment is a required property. It can't be null on creation.",
        8  => "The status is not a valid one.",
        9  => "One or more items have invalid price.",
        10 => "analyzed_by is a required property. It can't be null on update."
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
