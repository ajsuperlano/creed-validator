<?php namespace Creed\Validator\Rule;


class RuleIp extends Rule
{
	public $type = "ip.";


	public function validate()
	{	

		if (!isset($this->parameters['type'])) {
			return $this->ip();
		}
		if (!$this->ip()) {
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

	protected function ip()
	{
		return filter_var($this->value, \FILTER_VALIDATE_IP) !== false;
	}

	protected function v4()
	{
		return filter_var($this->value, \FILTER_VALIDATE_IP, \FILTER_FLAG_IPV4) !== false;
	}

	protected function v6()
	{
		return filter_var($this->value, \FILTER_VALIDATE_IP, \FILTER_FLAG_IPV6) !== false;
	}
}
