<?php namespace Creed\Validator\Rule;


class RuleUnique extends Rule
{
	public $type = "unique";

	public function validate()
	{
		$table = new $this->parameters[0]();
		$value = (isset($this->data[$this->parameters[1]])) ? $this->data[$this->parameters[1]] : $this->parameters[1];
		$operador = (isset($this->parameters[3])) ? $this->parameters[3] : '=';
		if (isset($this->parameters[2])) {
			return $table->where([
				[$this->parameters[1],$value],
				[$this->parameters[2],$operador, $this->data[$this->parameters[2]]]
			])->get()->isEmpty();
		}

		return $table->where($this->parameters[1], $value)->get()->isEmpty();
		
	}

}
