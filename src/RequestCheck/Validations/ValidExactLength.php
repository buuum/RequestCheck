<?php

namespace RequestCheck\Validations;


class ValidExactLength extends AbstractValidation
{

    public $value;

    public function __construct($value, $message = false)
    {
        $this->value = $value;
        parent::__construct($message);
    }

    public function validate($value)
    {
        if (function_exists('mb_strlen')) {
            return mb_strlen((string)$value) == $this->value;
        } else {
            return strlen((string)$value) == $this->value;
        }
    }

    public function getVars()
    {
        return [
            'value' => $this->value
        ];
    }
}