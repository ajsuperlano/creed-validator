<?php namespace Creed\Validator\Rule;

class RuleNotIn extends Rule
{
	public $type = "notIn";
	public $in;

	public function validate()
	{
		$this->in = new RuleIn($this->field, $this->value, $this->parameters,$this->data);
		return !$this->in->validate();
	}

}
