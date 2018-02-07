<?php

namespace RequestCheck;

use RequestCheck\Fields\InputObject;

class RequestResponse
{
    private $errors = [];
    private $messages = [];
    private $data;
    private $errorsKeys = [];

    public function __construct($messages = [])
    {
        $this->messages = $messages;
    }

    public function addError($fieldError)
    {
        $this->errorsKeys[$fieldError->name()] = $this->parseErrorsKeys($fieldError);
        $this->errors[] = $fieldError;
    }

    private function parseErrorsKeys($fieldError)
    {
        if (!empty($fieldError->subfields())) {
            return $this->errorsKeys($fieldError->subfields(), $fieldError->isArray());
        }
        return [];
    }

    private function errorsKeys($subfields, $isArray)
    {
        $parts = [];
        foreach ($subfields as $fieldError) {
            if ($isArray) {
                $position = empty($fieldError->position()) ? 1 : $fieldError->position();
                $parts[$fieldError->name()][$position] = $this->parseErrorsKeys($fieldError);
            } else {
                $parts[$fieldError->name()] = $this->parseErrorsKeys($fieldError);
            }
        }

        return $parts;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getErrorsKeys(): array
    {
        return $this->errorsKeys;
    }

}