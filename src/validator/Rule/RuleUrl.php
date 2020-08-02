<?php namespace Creed\Validator\Rule;


class RuleUrl extends Rule
{
	public $type = "url.";
	protected $Prefixes = array('http://', 'https://', 'ftp://');


	public function validate()
	{
		
		if (!isset($this->parameters['type'])) {
			return $this->url();
		}
		if (!$this->url()) {
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

	protected function url(){
		foreach ($this->Prefixes as $prefix) {
			if (strpos($this->value, $prefix) !== false) {
				return filter_var($this->value, \FILTER_VALIDATE_URL) !== false;
			}
		}
		return false;
	}

	public function active()
	{
		if (! is_string($this->value)) {
			return false;
		}
		if ($url = parse_url($this->value, PHP_URL_HOST)) {
			try {
				return count(dns_get_record($url, DNS_A | DNS_AAAA)) > 0;
			} catch (Exception $e) {
				return false;
			}
		}
		return false;
	}
}
