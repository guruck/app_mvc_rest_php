<?php
namespace Lib;

class Configuration{
  
  public static function init(){

    //definicoes de local tempo idioma
    date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_ALL,array('pt_BR','pt_BR.utf-8','portuguese'));

    // definir nivel de error reporting
    error_reporting(E_ERROR | E_PARSE);

    // constantes gerais
    define('DAILY_TIME', 60 * 60 * 8);

    // Diretorios
    define('MODEL_PATH', realpath(dirname(__FILE__) . '/../model'));
    define('VIEW_PATH', realpath(dirname(__FILE__) . '/../views'));
    define('ASSETS_PATH', realpath(dirname(__FILE__) . '/../../public/assets'));
    define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/../controllers'));
    // define('EXCEPTION_PATH', realpath(dirname(__FILE__) . '/../exceptions'));
    define('TEMPLATE_PATH', realpath(dirname(__FILE__) . '/../views/template'));

    session_start();
    
  }


}