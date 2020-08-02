<?php namespace Creed\Validator\Rule;

class RuleNotRegex extends Rule
{
	public $type = "notRegex";
	public $regex;

	public function validate()
	{
		$this->regex = new RuleRegex($this->$this->value, $this->parameters,$this->data);
		return !$this->regex->validate();
	}

}
