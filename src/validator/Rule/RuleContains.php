<?php namespace Creed\Validator\Rule;


class RuleContains extends Rule
{
	public $type = "contains";

	public function validate()
	{
		$this->str_replace["string"] = $this->parameters[0];
		
		if (!isset($this->parameters[0])) {
			return false;
		}
		if (!is_string($this->parameters[0]) || !is_string($this->value)) {
			return false;
		}

		$strict = true;
		if (isset($this->parameters[1])) {
			$strict = (bool)$this->parameters[1];
		}

		if ($strict) {
			if (function_exists('mb_strpos')) {
				$isContains = mb_strpos($this->value, $this->parameters[0]) !== false;
			} else {
				$isContains = strpos($this->value, $this->parameters[0]) !== false;
			}
		} else {
			if (function_exists('mb_stripos')) {
				$isContains = mb_stripos($this->value, $this->parameters[0]) !== false;
			} else {
				$isContains = stripos($this->value, $this->parameters[0]) !== false;
			}
		}
		return $isContains;
	}

}
