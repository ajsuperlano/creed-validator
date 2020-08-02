<?php namespace Creed\Validator\Rule;


class RuleConfirmed extends Rule
{
	public $type = "confirmed";


	
	public function validate()
	{
		$equals = new RuleEquals($this->field, $this->value, [$this->field.'_confirmation'], $this->data);
		return $equals->validate();
	}
}
