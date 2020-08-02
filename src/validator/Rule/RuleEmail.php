<?php namespace Creed\Validator\Rule;


class RuleEmail extends Rule
{
	public $type = "email";

	public function validate()
	{
		return filter_var($this->value, \FILTER_VALIDATE_EMAIL) !== false;
	}

}
