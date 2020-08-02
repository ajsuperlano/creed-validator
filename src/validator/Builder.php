<?php
namespace Creed\Validator;

use Creed\Validator\ValidatorException;

class Builder
{

	protected $fields   = array();
	protected $rules    = array();
	protected $data     = array(); 
	protected $errorMsj = array(); 
	protected $langMsj  = array(); 
	protected $def_lang = 'Es';
	protected $lang     = 'Es';
	
	protected $customAttributes  = array(); 
	protected $customMessages  = array(); 



	public function __construct()
	{
	}


	/**
	 * descripcion
	 * @param  array  $data            
	 * @param  array  $ArrRules        
	 * @param  array  $messages        
	 * @param  array  $customAttributes
	 * @return [type]                  
	 */ 

	public function rules(array $data, array $arrRules)
	{
		$this->data = $data;
		foreach ($arrRules as $field => $rules) {
			try {
				
				$this->checkData($field, $rules);
				
			} catch (ValidatorException $e) {
				echo $e->errorMessage();
			}
		}
		return $this;
	}

	protected function fieldArray($field)
	{
		$c = count($field);
		if ($c > 0 ) {
			$data = $this->data;
			for ($i=0; $i < $c; $i++) { 
				if (is_array($data)) {
					if (!isset($data[$field[$i]])) { 
						throw new ValidatorException ($field[$i].' no es un valor definido en los datos','100');
					}
					$data = $data[$field[$i]];                                
				}
			}
			return $data;
		}
		return NULL;
	}

	protected function addRuleArray($field, $data, $rules)
	{
		$field .= ($field == '') ? '' : '.' ;
		foreach ($data as $key => $value) {
			$this->addRule($field.$key, $rules, $value);
		}
	}

	protected function checkData($field, $rules)
	{
		
		$rules = explode('|', $rules);

		$pos = strpos($field, ".*");
		if ($pos || $field === '*' || $field === '.*' ) {
			$field = str_replace(".*", "", $field);

			$data = ($pos) ? $this->fieldArray(explode('.', $field)) : $this->data ;

			$this->addRuleArray($field, $data, $rules);
		} else {
			if (strpos($field, ".") ) {
				$value = $this->fieldArray(explode('.', $field));
			} else {
				if (!isset($this->data[$field])) { 
						throw new ValidatorException ($field.' no es un valor definido en los datos','100');
				}
				$value = $this->data[$field];
			}
			
			if (
				(!in_array('required', $rules) || in_array('optional', $rules)) && 
				(!isset($value) || $value === '' )
			) { 
				return; 
			}

			$this->addRule($field, $rules, $value);
		}
	}

	public function lang($lang = '')
	{
		if (isset($lang)) {
			$this->lang = $lang;
		} 
		return $this;
	}

	public function customAttributes(array $customAttributes = [])
	{
		$this->customAttributes = $customAttributes;
		return $this;
	}

	public function customMessages(array $customMessages = [])
	{
		$this->customMessages = $customMessages;
		return $this;
	}

	public function validate()
	{
		$totalError = 0;
		$this->addLang();
		try {
			foreach ($this->fields as $field => $rules) {
				foreach ($rules as $rule) {
					if (!$rule->validate()) {
						$totalError++;
						$this->errorMsj($field, $rule);
					} 
				}

			}

		} catch (ValidatorException $e) {
			echo $e->errorMessage();
		}
		return !$totalError;
	}

	/**
	 * [addRule description]
	 * @param [type] $field [description]
	 * @param [type] $rules [description]
	 */


	protected function addRule($field, $rules, $value)
	{		

		foreach ($rules as  $rule) 
		{
			if (strpos($rule, ":") !== false) {
				$parameters = explode(':', $rule);
				$rule = $parameters[0];
				$parameters = $this->formatParams($parameters, $rule);
				$this->addValidation($field,$rule,$value,$parameters);
			} else {
				if ($rule != 'optional') {
					$this->addValidation($field,$rule,$value,[]);
				}
			}
		}   

	}

	protected function formatParams(Array $parameters, String $rule)
	{
		$p = array_diff($parameters, array($rule));
		$parameters = Array();
		foreach ($p as $value) {
			$parameters[] = $value;
		}
		return $parameters;
	}

	protected function addValidation($field, $rule, $value , Array $parameters)
	{
		if (strpos($rule, "\\") !== false) {
			$rule_class = $rule;
		} else {
			if (strpos($rule, ".") ) {
				$rule = explode('.', $rule);
				$parameters['type'] = $rule[1];
				$rule = $rule[0];
			} 
			$rule_class = '\Creed\Validator\Rule\Rule' .  ucfirst($rule);
		}
		$rule_obj = new $rule_class($field, $value, $parameters, $this->data);    
		$this->fields[$field][] = $rule_obj;
		
	}

	protected function addLang( )
	{
		if (strpos($this->lang, "\\") !== false) {
			$lang_class = $this->lang;
		} else {
			$lang_class = '\Creed\Validator\Lang\\' .  ucfirst($this->lang);
		}
		$lang_obj = new $lang_class();
		$this->LangMsj = $lang_obj->lang();
	}



	protected function errorMsj($field, $rule)
	{
		$_field = $this->getCustomAtrributes($field, $rule);
		$message = $this->getCustomMessages($field, $rule, $_field);
		$message = str_replace(':attribute', $_field, $message);
		foreach ($rule->str_replace as $key => $value) {
			$message = str_replace(':'.$key, $value, $message);
		}

		$pos =  explode('.', $rule->type);
		$rule->type  = (isset($pos[1]) && $pos[1] != '') ? $rule->type : $pos[0];
		$this->errorMsj[$_field][$rule->type] = $message;
	}

	protected function getCustomMessages($field, $rule,$_field)
	{
		if (isset($this->customMessages[$field.'.'.$rule->type])) {
			$message = $this->customMessages[$field.'.'.$rule->type];
		} else {
			if (strpos($rule->type, ".") !== false) {
				$type = explode('.', $rule->type);
				$type[1] = (isset($type[1]) && $type[1] != '') ? $type[1] : 0 ;				
				$message = $this->LangMsj[$type[0]][$type[1]];	
			} else {
				$message = $this->LangMsj[$rule->type];
			}		
		}
		return $message;
	}

	protected function getCustomAtrributes($field)
	{
		if (isset($this->customAttributes[$field])) {
			return $this->customAttributes[$field];
		} else {
			return $field;
		}
	}

	public function getErrors()
	{
		return $this->errorMsj;
	}



}
