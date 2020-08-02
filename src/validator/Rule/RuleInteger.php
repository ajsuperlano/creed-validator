<?php namespace Creed\Validator\Rule;

	class RuleInteger extends Rule
	{
		public $type = "integer";
		
		public function validate()
		{
			if (isset($this->parameters[0]) && (bool)$this->parameters[0]) {
            //strict mode
				return preg_match('/^([0-9]|-[1-9]|-?[1-9][0-9]*)$/i', $this->value);
			}
			return filter_var($this->value, \FILTER_VALIDATE_INT) !== false;
		}

	}
