<?php
namespace Lib;
use Dao\Menu as Menu;

class Carregador{
  private $menus;
  public static function loadView($viewName, $params = array()){
    if(count($params) > 0){

      foreach ($params as $key => $value) {
        if(strlen($key) > 0){
          ${$key} = $value;
        }
      }
    }
    $file = VIEW_PATH . "/{$viewName}.php";
    if (file_exists($file)) {
      require_once ($file);
    }
  }

  public static function loadTemplateView($viewName, $params = array()){
    if(count($params) > 0){
      foreach ($params as $key => $value) {
        if(strlen($key) > 0){
          ${$key} = $value;
        }
      }
    }
    $menus = Menu::get();
    require_once(TEMPLATE_PATH . "/header.php");
    require_once(TEMPLATE_PATH . "/menu_left.php");
    require_once(VIEW_PATH . "/{$viewName}.php");
    require_once(TEMPLATE_PATH . "/footer.php");
  }

}