<?php namespace Creed\Validator\Rule;

class RuleAlpha extends Rule
{
	public $type = "alpha.";
	
	public function validate()
	{	

		if (!isset($this->parameters['type'])) {
			return $this->alpha();
		}

		$this->type .= $this->parameters['type'];
		if ($this->parameters['type'] === 'dash') {
			return $this->alphaDash();
		}

		if ($this->parameters['type'] === 'num') {
			return $this->alphaNum();
		}

	}
	public function alpha()
	{
		return preg_match('/^([a-z])+$/i', $this->value);
	}

	public function alphaDash()
	{
		if (! is_string($this->value) && ! is_numeric($this->value)) {
			return false;
		}

		return preg_match('/^[\pL\pM\pN_-]+$/u', $this->value) > 0;
	}
	public function alphaNum()
	{
		if (! is_string($this->value) && ! is_numeric($this->value)) {
			return false;
		}

		return preg_match('/^[\pL\pM\pN_-]+$/u', $this->value) > 0;
	}

}
