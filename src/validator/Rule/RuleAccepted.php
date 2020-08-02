<?php namespace Creed\Validator\Rule;

// use Creed\Validator\Rule\RuleRequired;

class RuleAccepted extends Rule
{
	public $type = "accepted";
	public $acceptable = array('yes', 'on', 1, '1', true);
	
	public $require;

	public function validate()
	{
		$this->required = new RuleRequired($this->field, $this->value, $this->parameters);
		return $this->required->validate() && in_array($this->value, $this->acceptable, true);
	}

}
