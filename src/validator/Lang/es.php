<?php namespace Creed\Validator\Lang;

			/**
			* 
			*/
			class Es
			{
				protected $lang = [
					'accepted'      => 'El campo :attribute debe ser aceptado.',
					'alpha'         => [
						'El campo :attribute sólo puede contener letras.',
						'dash'          => 'El campo :attribute sólo puede contener letras, números y guiones (a-z, 0-9, -_).',
						'num'           => 'El campo :attribute sólo puede contener letras y números.',
					],
					'array'         => [
						'El campo :attribute debe ser un array.',
						'between'       => 'El campo :attribute debe contener entre :min y :max elementos.',
						'max'           => 'El campo :attribute no debe contener más de :max elementos.',
						'min'           => 'El campo :attribute debe contener al menos :min elementos.',
						'size'          => 'El campo :attribute debe contener :size elementos.',
					],
					'boolean'       => 'El campo :attribute debe ser verdadero o falso.',
					'confirmed'     => 'El campo confirmación de :attribute no coincide.',
					'contains'      => 'El campo :attribute debe contener :string.',
					'date'          => [
						'El campo :attribute no corresponde con una fecha válida.',
						'format'        => 'El campo :attribute no corresponde con el formato de fecha :format.',
						'after'         => 'El campo :attribute debe ser una fecha posterior a :date.',
						'afterSame'     => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
						'before'        => 'El campo :attribute debe ser una fecha anterior a :date.',
						'beforeSame'    => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
						'between'       => 'El campo :attribute debe ser una fecha entre :min y :max.',
					],
					'different'     => 'Los campos :attribute y :other deben ser diferentes.',
					'digits'        => [
						'El campo :attribute debe ser un número de :digits dígitos.',
						'between'       => 'El campo :attribute debe contener entre :min y :max dígitos.',
					],
			'dimensions'    => 'El campo :attribute tiene dimensiones inválidas.',//falta
			'email'         => 'El campo :attribute debe ser una dirección de correo válida.',
			'equals'        => 'Los campos :attribute y :other deben coincidir.',
			'exists'        => 'El campo :attribute seleccionado no existe.',//falta
			'file'          => [
				'El campo :attribute debe ser un archivo.',
				'between'       => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',//falta
				'max'           => 'El archivo :attribute no debe pesar más de :max kilobytes.',//falta
				'min'           => 'El archivo :attribute debe pesar al menos :min kilobytes.',//falta
				'mime'         => 'El campo :attribute debe ser un archivo de tipo :values.',//falta
				'mimes'     => 'El campo :attribute debe ser un archivo de tipo :values.',//falta
				'size'          => 'El archivo :attribute debe pesar :size kilobytes.',//falta
			],
			'image'         => 'El campo :attribute debe ser una imagen.',//falta
			'in'            => 'El campo :attribute es inválido.',
			'integer'       => 'El campo :attribute debe ser un número entero.',
			'ip'            => [
				'El campo :attribute debe ser una dirección IP válida.',
				'v4'            => 'El campo :attribute debe ser una dirección IPv4 válida.',
				'v6'            => 'El campo :attribute debe ser una dirección IPv6 válida.',
			],
			'json'          => 'El campo :attribute debe ser una cadena de texto JSON válida.',
			'notIn'         => 'El campo :attribute seleccionado es inválido.',
			'notRegex'      => 'El formato del campo :attribute es inválido.',
			'numeric'       => [
				'El campo :attribute debe ser un número.',
				'between'       => 'El campo :attribute debe ser un valor entre :min y :max.',
				'max'           => 'El campo :attribute no debe ser mayor a :max.',
				'min'           => 'El campo :attribute debe tener al menos :min.',
				'size'          => 'El campo :attribute debe ser :size.',
			],
			'regex'         => 'El formato del campo :attribute es inválido.',
			'required'      => [
				'El campo :attribute es obligatorio.',
				'if'            => 'El campo :attribute es obligatorio cuando el campo :other es :value.',//falta
				'unless'        => 'El campo :attribute es requerido a menos que :other se encuentre en :values.',//falta
				'with'          => 'El campo :attribute es obligatorio cuando :values está presente.',//falta
				'with_all'      => 'El campo :attribute es obligatorio cuando :values está presente.',//falta
				'without'       => 'El campo :attribute es obligatorio cuando :values no está presente.',//falta
				'without_all'   => 'El campo :attribute es obligatorio cuando ninguno de los campos :values está presente.',//falta
			],
			'string'        => [
				'El campo :attribute debe ser una cadena de caracteres.',
				'between'       => 'El campo :attribute debe contener entre :min y :max caracteres.',
				'max'           => 'El campo :attribute no debe contener más de :max caracteres.',
				'min'           => 'El campo :attribute debe contener al menos :min caracteres.',
				'size'          => 'El campo :attribute debe contener :size caracteres.',
			],
			'timezone'      => 'El campo :attribute debe contener una zona válida.',//falta
			'unique'        => 'El valor del campo :attribute ya está en uso.',//falta
			'uploaded'      => 'El campo :attribute falló al subir.',//falta
			'url'           => [
				'El formato del campo :attribute es inválido.',
				'active'        => 'El campo :attribute no es una URL válida.'
			],//falta
		];

		public function lang()
		{
			return $this->lang;
		}       
	}