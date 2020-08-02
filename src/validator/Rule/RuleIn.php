<?php namespace Creed\Validator\Rule;

class RuleIn extends Rule
{
	public $type = "in";
	
	public function validate()
	{
		$this->parameters[0] = $this->data[$this->parameters[0]];
		$isAssoc = array_values($this->parameters[0]) !== $this->parameters[0];
		if ($isAssoc) {
			$this->parameters[0] = array_keys($this->parameters[0]);
		}
		$strict = false;
		if (isset($this->parameters[1])) {
			$strict = $this->parameters[1];
		}
		return in_array($this->value, $this->parameters[0], $strict);
	}

}
