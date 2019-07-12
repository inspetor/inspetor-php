<?php

namespace Inspetor\Exception\ModelException;

use Inspetor\Exception\ExceptionAbstract;

class InspetorCreditCardException extends ExceptionAbstract {

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
    const HEADER = "INSPETOR EXCEPTION - CREDIT CARD";

    /**
     * @var array
     */
    protected static $messages = array(
        1 => "first_six_digits is a required property. It can't be null.",
        2 => "last_four_digits is a required property. It can't be null.",
        3 => "holder_name is a required property. It can't be null.",
        4 => "holder_cpf is a required property. It can't be null.",
        5 => "billing_address is a required property. It can't be null."
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
