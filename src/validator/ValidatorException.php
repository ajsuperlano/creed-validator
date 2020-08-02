<?php 
namespace Creed\Validator;
 class ValidatorException extends \Exception {
    public function errorMessage() {
        // Mensaje de error
        // 
        $trace = $this->getTrace();
        $errorMsg = '';
        // print_r($trace);
        $c = count($trace);
      for ($i=0; $i < $c ; $i++) { 
          # code...
        $errorMsg .= '<br><br><br> ---- <b> Mensaje : '.$this->getMessage(). '</b>'
        .' <br>---- En el archivo  '.$trace[$i]['file']
        .' <br>---- Error en la línea '.($trace[$i]['line'])
        // .' <br>---- Codigo del error '.$this->getCode() 
        .' <br>---- En la funcion  '.$trace[$i]['function'].'() de la clase '.$trace[$i]['class'].'<br>';
      }
        return $errorMsg;
    }
}
