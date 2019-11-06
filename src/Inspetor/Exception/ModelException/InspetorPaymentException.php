<?php

namespace Inspetor\Exception\ModelException;

use Inspetor\Exception\ExceptionAbstract;

class InspetorPaymentException extends ExceptionAbstract {

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
        1 => "id is a required property. It cannot be null.",
        2 => "method is a required property. It cannot be null.",
        3 => "installments is a required property. It must be an integer greater than zero.",
        4 => "payment method invalid.",
        5 => "Credit card cannot be null when method is credit_card."
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
