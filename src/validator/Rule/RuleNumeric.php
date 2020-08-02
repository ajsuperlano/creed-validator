<?php namespace Creed\Validator\Rule;

class RuleNumeric extends Rule
{
	use Size;
	public $type = "numeric.";
	
	public function validate()
	{	

		if (!isset($this->parameters['type'])) {
			return $this->numeric();
		}
				
		if (!$this->numeric()) {
			return false;
		}

		$this->type .= $this->parameters['type'];
		
		$function = $this->parameters['type'];
		if (method_exists($this,$function) ) {

			return $this->$function();
		} else {
			echo "no exite {$function}";
		}
	}
	public function numeric()
	{
		return is_numeric($this->value);
	}

}
