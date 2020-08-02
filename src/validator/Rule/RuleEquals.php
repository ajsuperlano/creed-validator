<?php namespace Creed\Validator\Rule;


class RuleEquals extends Rule
{
	public $type = "equals";
	
	public function validate()
	{
		$this->requireParameters(1);
		$this->str_replace["other"] =  $this->parameters[0]; 
		$this->parameters[0] = (isset($this->data[$this->parameters[0]])) ? $this->data[$this->parameters[0]] : $this->parameters[0];
		return $this->value == $this->parameters[0];
	}

}
