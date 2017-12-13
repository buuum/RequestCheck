<?php

namespace RequestCheck\Validations;


class ValidMaxLength extends AbstractValidation
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
            $len = mb_strlen($value);
        } else {
            $len = strlen($value);
        }
        return $len <= $this->value;
    }

    public function getVars()
    {
        return [
            'value' => $this->value
        ];
    }

}