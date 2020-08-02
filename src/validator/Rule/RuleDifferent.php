<?php namespace Creed\Validator\Rule;


class RuleDifferent extends Rule
{
	public $type = "different";
	
	public function validate()
	{
		$this->str_replace["other"] = $this->parameters[0];
		$parameters = $this->data[$this->parameters[0]];
		return $this->value != $parameters;
	}

}
