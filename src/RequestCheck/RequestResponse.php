<?php

namespace RequestCheck;

class RequestResponse
{
    private $errors = [];
    private $messages = [];
    private $data;

    public function __construct($messages = [])
    {
        $this->messages = $messages;
    }

    public function addError($fieldError)
    {
        $this->errors[] = $fieldError;
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

}