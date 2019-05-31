<?php

namespace Inspetor\Exception;

class TrackerException extends ExceptionAbstract
{

    /**
     * Category of Exception
     */
    const CATEGORY = 9000;

    /**
     * Description of Exception
     */
    const DESCRIPTION = "Missing parameters and wrong variable values will throw this category of error.";

    /**
     * Header of message
     */
    const HEADER = "INSPETOR EXCEPTION";

    /**
     * @var array
     */
    protected static $messages = array(
        1 => "AppId and trackerName are required parameters.",
        2 => "Tracker not found.",
        3 => "Invalid Context! Authentication valid contexts:  \"user_login\", \"user_logout\".",
        4 => "Invalid Context! User valid contexts: \"user_create\", \"user_update\", \"user_delete\".",
        5 => "Invalid Context! Order valid contexts: \"new_order\", \"order_refund\".",
        6 => "Invalid Context! Sale valid contexts: \"sale_payment\", \"sale_cancelled\", \"sale_declined\", \"sale_refund\".",
        7 => "Invalid Context! Tranfer valid contexts: \"transfer_create\", \"transfer_update\".",
        8 => "Invalid Context! Password request valid contexts: \"password_reset\", \"password_recovery\".",
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
