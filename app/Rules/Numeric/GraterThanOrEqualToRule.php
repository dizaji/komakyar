<?php

namespace App\Rules\Numeric;

class GraterThanOrEqualToRule extends GraterThanRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (array_key_exists($this->other_field_name, $this->data))
            return parent::passes($attribute, $value) || $value == $this->data[$this->other_field_name];

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return sprintf('The :attribute must be grater than or equal to %s.', $this->other_field_name);
    }
}
