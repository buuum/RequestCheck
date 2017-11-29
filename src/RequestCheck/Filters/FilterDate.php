<?php

namespace RequestCheck\Filters;

class FilterDate implements Filter {

    private $basePattern;
    private $resultPattern;

    public function __construct($basePattern, $resultPattern)
    {
        $this->basePattern = $basePattern;
        $this->resultPattern = $resultPattern;
    }

    public function filter($value)
    {
        if($myDateTime = \DateTime::createFromFormat($this->basePattern, $value)){
            return $myDateTime->format($this->resultPattern);
        }

        return $value;
    }
}