<?php

namespace Inspetor\Exception;

use Inspetor\Exception\ExceptionAbstract;

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
        2 => "Invalid Context! Authentication valid contexts:  \"account_login\", \"account_logout\".",
        3 => "Invalid Context! User valid contexts: \"account_create\", \"account_update\", \"account_delete\".",
        4 => "Invalid Context! Order valid contexts: \"new_order\", \"order_refund\".",
        5 => "Invalid Context! Sale valid contexts: \"sale_create\", \"sale_update_status\".",
        6 => "Invalid Context! Tranfer valid contexts: \"transfer_create\", \"transfer_update_status\".",
        7 => "Invalid Context! Password request valid contexts: \"password_reset\", \"password_recovery\".",
        8 => "Invalid Context! Event request valid contexts: \"event_create\", \"event_update\", \"event_delete\".",
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
