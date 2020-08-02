<?php namespace Creed\Validator\Rule;

use Creed\Validator\ValidatorException; 

class Rule 
{
	public $value;
	public $parameters = array();
	public $data = array();
	public $str_replace = array();

	public function __construct($field, $value, $parameters = [], $data = [])
	{
		$this->field = $field;
		$this->value = $value;
		$this->parameters = $parameters;
		$this->data = $data;
	}

	public function validate()
	{
		return false;
	}

	protected function requireParameters($count)
    {
    	
        if (count($this->parameters) < $count) {
            throw new ValidatorException("Validation rule $this->type requires at least $count parameters.");
        }
    }
}
