<?php

namespace Inspetor\Exception;

use Exception;

abstract class ExceptionAbstract extends Exception
{

    /**
     * Code of Exception
     */

    const CODE = 200;

    /**
     * Key to Substring
     */

    const KEY_TO_SUBSTRING = -3;

    /**
     * Number of fields
     */
    const NUMBER_FIELDS = 1;

    /**
     * Start of substring
     */
    const MESSAGE_SUBSTRING_START = 0;

    /**
     * Length of substring
     */
    const MESSAGE_SUBSTRING_LENGTH = -2;


    /**
     * @var array
     */
    protected static $messages;

    /**
     *
     * @var array
     */
    private $errorArray;

    public function getErrorArray()
    {
        return $this->errorArray;
    }

    /**
     * @param array $errorArray
     */
    public function setErrorArray($errorArray)
    {
        $this->errorArray = $errorArray;
    }

    public function __construct($fullMessage, $code)
    {
        if (!isset($code)) {
            $code = self::CODE;
        }

        parent::__construct($fullMessage, $code);

        $this->code = self::CODE;
    }

    /**
     * @param type $code
     * @param type $fields
     * @param type $header
     * @return array
     */
    protected function getMessageByCode($code, $fields, $header)
    {
        $arrayKeyToSubstring = self::KEY_TO_SUBSTRING;
        $getCode = intval(substr($code, $arrayKeyToSubstring));

        $class = get_called_class();
        $codeMessage = $class::$messages[$getCode];

        if (!empty($fields)) {
            if (count($fields) === self::NUMBER_FIELDS) {
                if (is_array($fields[key($fields)])) {
                    $value = implode(",", $fields[key($fields)]);
                } else {
                    $value = $fields[key($fields)];
                }

                $countFields = key($fields) . '=> ' . $value;
            } else {
                $messages = "";

                while (list ($key, $val) = each($fields)) {
                    if (is_array($val)) {
                        $value = implode(",", $val);
                    } else {
                        $value = $val;
                    }
                    $messages .= "$key => $value, ";
                }
                $countFields = substr($messages, self::MESSAGE_SUBSTRING_START, self::MESSAGE_SUBSTRING_LENGTH) . ".";
            }
            $codeMessage = $codeMessage . PHP_EOL . 'Fields: ' . $countFields;
        }

        $fullMessage = $header . " - ERROR " . $code . " - " . $codeMessage;

        $errorArray = array (
            'status' => false,
            'category' => $header,
            'code' => $code,
            'message' => $codeMessage,
            'fields' => $fields
            );

        $this->setErrorArray($errorArray);

        return $fullMessage;
    }

    public static function getList()
    {
        $class = get_called_class();
        foreach ($class::$messages as $value) {
            yield $value;
        }
    }
}
