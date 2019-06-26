<?php

namespace Inspetor\Inspetor\Exception\ModelException;

use Inspetor\Inspetor\Exception\ExceptionAbstract;

class TrackerException extends ExceptionAbstract {

    /**
     * Category of Exception
     */
    const CATEGORY = 8000;

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
        1 => "Id is a required propertie. It can't be null neither ''",
        2 => "Update_timestamp is a required propertie. It can't be null neither ''",
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
