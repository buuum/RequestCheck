<?php

namespace RequestCheck\Fields;

class InputError
{

    private $input;
    private $position;
    private $errors = [];
    private $subfields = [];
    private $is_array;

    public function __construct(AbstractInput $input, $isArray = false)
    {
        $this->input = $input;
        $this->position = $input->position();
        $this->is_array = $isArray;
    }

    public function position()
    {
        return $this->position !== false ? $this->position + 1 : '';
    }

    public function alias()
    {
        return $this->input->alias();
    }

    public function name()
    {
        return $this->input->name();
    }

    public function input()
    {
        return $this->input;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function addSubfield($fieldError)
    {
        $this->subfields[] = $fieldError;
    }

    public function subfields()
    {
        return $this->subfields;
    }

    public function isValid()
    {
        return empty($this->errors) && empty($this->subfields());
    }

    public function isArray()
    {
        return $this->is_array;
    }

}