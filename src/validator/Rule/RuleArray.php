<?php namespace Creed\Validator\Rule;

class RuleArray extends Rule
{
	use Size;
	public $type = "array.";
	
	public function validate()
	{	

		if (!isset($this->parameters['type'])) {
			return $this->array();
		}
		if (!$this->array()) {
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
	public function array()
	{
		return is_array($this->value);
	}

}
