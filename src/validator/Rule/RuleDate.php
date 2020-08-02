<?php namespace Creed\Validator\Rule;


class RuleDate extends Rule
{
	public $type = "date.";
	protected $vtime;
	protected $ptime;
	protected $p2time;

	public function validate()
	{	
		
		if (!isset($this->parameters['type'])) {
			return $this->date();
		}


		if (!$this->date()) {
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
	protected function date()
	{
		$isDate = false;
		if ($this->value instanceof \DateTime) {
			$isDate = true;
		} else {
			$isDate = strtotime($this->value) !== false;
		}
		return $isDate;
	}
	protected function after()
	{
		$this->getTime();
		return $this->vtime > $this->ptime;
	}
	protected function afterSame()
	{
		$this->getTime();
		return $this->vtime >= $this->ptime;
	}

	protected function before()
	{
		$this->getTime();
		return $this->vtime < $this->ptime;
	}
	protected function beforeSame()
	{
		$this->getTime();
		return $this->vtime <= $this->ptime;
	}

	protected function between()
	{
		$this->getTime();
		return $this->vtime >= $this->ptime && $this->vtime <= $this->p2time ;
	}

	public function format()
	{
		$this->str_replace["format"] =  $this->parameters[0]; 
		$parsed = date_parse_from_format($this->parameters[0], $this->value);
		return $parsed['error_count'] === 0 && $parsed['warning_count'] === 0;
	}

	public function getTime($value='')
	{
		$this->requireParameters(1);
		$this->str_replace["date"] =  $this->parameters[0]; 

		$this->vtime = ($this->value instanceof \DateTime) ? $this->value->getTimestamp() : strtotime($this->value);
		$this->ptime = ($this->parameters[0] instanceof \DateTime) ? $this->parameters[0]->getTimestamp() : strtotime($this->parameters[0]);
		if (isset($this->parameters[1])) {
			$this->requireParameters(2);
			$this->str_replace["min"] =  $this->parameters[0]; 
			$this->str_replace["max"] =  $this->parameters[1]; 
			$this->p2time = ($this->parameters[1] instanceof \DateTime) ? $this->parameters[1]->getTimestamp() : strtotime($this->parameters[1]);
		}
	}

}
