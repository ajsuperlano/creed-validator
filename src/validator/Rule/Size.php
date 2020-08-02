<?php namespace Creed\Validator\Rule;

Trait Size 
{
	public function getSize()
	{
		if (is_numeric($this->value)) {
			return $this->value;
		} elseif (is_array($this->value)) {
			return count($this->value);
		} elseif ($this->value instanceof File) {
			return $this->value->getSize() / 1024;
		}
		return mb_strlen($this->value);
	}

	public function between()
	{
		$this->requireParameters(2);
		$this->str_replace["min"] =  $this->parameters[0];
		$this->str_replace["max"] =  $this->parameters[1];
		$size = $this->getSize();
		return ($size !== false) && $size >= $this->parameters[0] && $size <= $this->parameters[1];
	}
	public function min()
	{
		$this->requireParameters(1);	
		$this->str_replace["min"] =  $this->parameters[0];
		$size = $this->getSize();
		return ($size !== false) && $size >= $this->parameters[0];	
	}
	public function max()
	{
		$this->requireParameters(1);	
		$this->str_replace["max"] =  $this->parameters[0];
		$size = $this->getSize();
		return ($size !== false) && $size <= $this->parameters[0];	
	}
	public function size()
	{
		$this->requireParameters(1);	
		$this->str_replace["size"] =  $this->parameters[0];
		$size = $this->getSize();
		return ($size !== false) && $size == $this->parameters[0];		
	}
}
