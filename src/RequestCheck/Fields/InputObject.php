<?php

namespace RequestCheck\Fields;

class InputObject extends AbstractInput
{
    private $inputs;

    public function __construct($name, InputCollection $inputs, $required = false)
    {
        $this->inputs = $inputs;
        parent::__construct($name, $required);
    }

    public function filter($data)
    {
        foreach ($this->inputs as $input) {
            if (!empty($data[$input->name()])) {
                $data[$input->name()] = $input->filter($data[$input->name()]);
            }
        }

        return $data;
    }

    public function validate($data)
    {
        $this->errors_class = new InputError($this);

        if (!$this->required && empty($data)) {
            return $this->errors_class->isValid();
        }

        foreach ($this->validations as $validation) {
            if (!$validation->validate($data)) {
                $this->errors_class->addError(new MessageError($this, $validation));
            }
        }

        foreach ($this->inputs as $input) {
            if (!$input->validate($data[$input->name()] ?? '')) {
                $this->errors_class->addSubfield($input->getErrors());
            }
        }

        return $this->errors_class->isValid();
    }
}