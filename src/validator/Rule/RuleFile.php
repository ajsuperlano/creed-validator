<?php namespace Creed\Validator\Rule;

class RuleFile extends Rule
{
	use Size;
	public $type = "file.";
	
	public function validate()
	{	

		if (!isset($this->parameters['type'])) {
			return $this->file();
		}
		if (!$this->file()) {
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
	protected function file()
	{
		print_r($this->value);
		if (
			!isset($this->value['type']) || $this->value['type'] == '' ||
			!isset($this->value['tmp_name']) || $this->value['tmp_name'] == ''||
			!isset($this->value['size']) || $this->value['size'] == ''||
			!isset($this->value['name']) || $this->value['name'] == ''
		) 
		{
			return false;
		}
		return 1;
	}

	protected function mime()
	{
		$this->requireParameters(1);	
		$this->str_replace["values"] =  $this->parameters[0];
		
		print_r(getimagesize($this->value['tmp_name']));
		$file = getimagesize($this->value['tmp_name']);
		return $file['mime'] ==  $this->parameters[0];
        // '' && in_array($this->value->guessExtension(), $this->parameters);
	}

    /**
     * Check that the given value is a valid file instance.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function isValidFileInstance()
    {
    	if ($this->value instanceof UploadedFile && ! $this->value->isValid()) {
    		return false;
    	}

    	print_r($this->value);

    	echo  'hola'.$this->value instanceof File;
    	return $this->value instanceof File;
    }

  }
