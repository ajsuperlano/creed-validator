<?php namespace Creed\Validator\Rule;


class RuleBoolean extends Rule
{
	public $type = "boolean";

	public function validate()
	{
		return is_bool($this->value);
	}

}
