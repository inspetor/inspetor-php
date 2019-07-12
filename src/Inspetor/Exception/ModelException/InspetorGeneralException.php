<?php

namespace Inspetor\Exception\ModelException;

use Inspetor\Exception\ExceptionAbstract;

class InspetorGeneralException extends ExceptionAbstract {

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
    const HEADER = "INSPETOR EXCEPTION";

    /**
     * @var array
     */
    protected static $messages = array(
        1 => "The timestamp should be an integer.",
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
