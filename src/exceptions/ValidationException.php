<?php
namespace Errors;
class ValidationException extends AppException{

  private $errors = [];

  public function __construct($errors = [], 
    $message = 'Erros de validação',
    $code = 0, 
    $previus = null
    ){
    parent::__construct($message, $code, $previus);
    //$errors['message'] = 'Erros de validação'; //necessario se usar o __get
    $this->errors = $errors;
  }

  public function get($key){ // verificar possibilidade do uso do "magico" __get
    return $this->errors[$key];
  }

  public function getErrors(){
    return $this->errors;
  }
}