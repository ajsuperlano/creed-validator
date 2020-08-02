<?php namespace Creed\Validator\Rule;

class RuleRegex extends Rule
{
	public $type = "regex";
	
	public function validate()
	{
		$this->data[$this->parameters[0]];
		return preg_match($this->data[$this->parameters[0]], $this->value);
	}

}
