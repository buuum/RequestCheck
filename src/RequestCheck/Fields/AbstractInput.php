<?php

namespace RequestCheck\Fields;

use RequestCheck\Filters\Filter;
use RequestCheck\Validations\AbstractValidation;
use RequestCheck\Validations\ValidRequired;

abstract class AbstractInput implements InterfaceInput
{

    protected $name;
    protected $alias;
    protected $required;
    /**
     * @var Filter []
     */
    protected $filters = [];
    /**
     * @var AbstractValidation []
     */
    protected $validations = [];
    protected $errors_class;
    protected $position = false;
    protected $error_messages;

    public function __construct($name, $required = false)
    {
        $this->name = $name;
        $this->required = $required;
        if ($this->required) {
            $this->validations[] = new ValidRequired();
        }
    }

    public function setFilters($filters)
    {
        $this->filters = $filters;
        return $this;
    }

    public function setValidations($validations)
    {
        $this->validations = array_merge($this->validations, $validations);
        return $this;
    }

    public function name()
    {
        return $this->name;
    }

    public function filters()
    {
        return $this->filters;
    }

    public function validations()
    {
        return $this->validations;
    }

    public function getErrors()
    {
        return $this->errors_class;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    public function alias()
    {
        return $this->alias ? $this->alias : $this->name;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function position()
    {
        $position = $this->position;
        $this->position = false;
        return $position;
    }

    public function setErrorMessages($messages)
    {
        $this->error_messages = $messages;
    }

}