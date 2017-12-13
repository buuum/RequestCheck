<?php

namespace RequestCheck\Validations;

class ValidObjectDate extends AbstractValidation
{

    public $fields;
    private $format;
    private $separator;

    public function __construct($fields = [], $format, $separator = '/', $message = false)
    {
        $this->fields = $fields;
        $this->format = $format;
        $this->separator = $separator;
        parent::__construct($message);
    }

    public function validate($value)
    {
        $date = [];
        foreach ($this->fields as $field) {
            if (!isset($value[$field->name()])) {
                return false;
            }
            $date[] = $value[$field->name()];
        }

        $date = implode($this->separator, $date);

        $d = \DateTime::createFromFormat($this->format, $date);
        return $d && ($d->format($this->format) === $date);
    }

    public function getVars()
    {
        return [
            'format' => $this->format
        ];
    }
}