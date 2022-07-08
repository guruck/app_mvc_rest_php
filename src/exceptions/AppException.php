<?php
namespace Errors;
class AppException extends \Exception{

  public function __construct($message, $code = 0, $previus = null){
    parent::__construct($message, $code, $previus);
  }

  public function __get($key){
    return $this->$key;
  }
}