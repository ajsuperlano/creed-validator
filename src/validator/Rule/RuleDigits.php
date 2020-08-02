<?php namespace Creed\Validator\Rule;

class RuleDigits extends Rule
{
	use Size;
	public $type = "digits.";
	
	public function validate()
	{	

		if (!isset($this->parameters['type'])) {
			return $this->digits();
		}

		$this->type .= $this->parameters['type'];
		$this->str_replace["min"] =  $this->parameters[0];
		$this->str_replace["max"] = (isset($this->parameters[1])) ? $this->parameters[1] : '' ; 
		if (!$this->digits()) {
			return false;
		}

		$function = $this->parameters['type'];
		if (method_exists($this,$function) ) {
			return $this->$function();
		} else {
			echo "no exite {$function}";
		}
	}

	public function digits()
	{
		$this->requireParameters(1);
		$this->str_replace['digits'] = $this->parameters[0];
		return ! preg_match('/[^0-9]/', $this->value)
		&& strlen((string) $this->value) == $this->parameters[0];
	}

	protected function between()
	{
		$this->requireParameters(2);

		$length = strlen((string) $this->value);

		return ! preg_match('/[^0-9]/', $this->value)
		&& $length >= $this->parameters[0] && $length <= $this->parameters[1];
	}

}
