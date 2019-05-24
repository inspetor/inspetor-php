<?php

namespace Inspetor\Inspetor\Exception;

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
    const HEADER = "TRACKER EXCEPTION";

    /**
     * @var array
     */
    protected static $messages = array(
        1  => "AppId and trackerName are required parameters.",
        2  => "Tracker not found."
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
