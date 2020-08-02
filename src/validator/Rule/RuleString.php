<?php namespace Creed\Validator\Rule;

// use Creed\Validator\Rule\StringLength;

class RuleString extends Rule
{
	use Size;

	public $type = "string.";

		public function validate()
	{	

		if (!isset($this->parameters['type'])) {
			return $this->string();
		}
				
		if (!$this->string()) {
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

	public function string()
	{
		return is_string($this->value);
	}

}
