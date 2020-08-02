<?php namespace Creed\Validator\Rule;


class RuleRequired extends Rule
{
	public $type = "required.";

	public function validate()
	{	
		if (!isset($this->parameters['type'])) {
			return $this->required();
		}

		if (!$this->required()) {
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

	protected function required()
	{
		if (is_null($this->value)) {
			return false;
		} elseif (is_string($this->value) && trim($this->value) === '') {
			return false;
		}
		return true;
	}

}
