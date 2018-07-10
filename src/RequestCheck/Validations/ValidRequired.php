<?php

namespace RequestCheck\Validations;


class ValidRequired extends AbstractValidation
{

    public function validate($value)
    {
        if (!is_numeric($value) && empty($value)) {
            return false;
        }

        return true;
    }
}