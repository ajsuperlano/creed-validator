<?php namespace Creed\Validator\Rule;

class RuleJson extends Rule
{
	public $type = "json";
	

	public function validate()
	{
		if (! is_scalar($this->value) && ! method_exists($this->value, '__toString')) {
			return false;
		}
		json_decode($this->value);
		return json_last_error() === JSON_ERROR_NONE;
	}

}
