<?php

namespace App\Rules\Numeric;

use Illuminate\Contracts\Validation\Rule;

class GraterThanRule implements Rule
{
    protected $other_field_name;
    protected $data;

    /**
     * Create a new rule instance.
     * @param $other_field_name
     * @param array $data
     */
    public function __construct($other_field_name, array $data)
    {
        //
        $this->other_field_name = $other_field_name;
        $this->data = $data;
    }

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
            return $value > $this->data[$this->other_field_name];

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return sprintf('The :attribute must be grater than %s.', $this->other_field_name);
    }
}
