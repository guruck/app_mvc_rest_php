<?php
namespace Lib;
use Dao\Menu as Menu;
use Dao\WorkingHours as WorkingHours;
use Lib\DateUtils as DateUtils;

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

    $user = $_SESSION['user'];
    $pathAvatar = ASSETS_PATH.'/uploads/';
    
    $userAvatar = ''; 
    $defautlAvatar= '/assets/img/user_avatar.png';

    $types = array( 'png', 'jpg', 'jpeg', 'gif' );
    if ( $handle = opendir($pathAvatar) ) {
        while ( $entry = readdir( $handle ) ) {
            $ext = strtolower( pathinfo( $entry, PATHINFO_EXTENSION) );
            if( in_array( $ext, $types ) ) {
              if (strpos($entry, $user->name.'.')!==false) $userAvatar = $entry;
              break;
            }
        }
        closedir($handle);
    }
    $userAvatar = ($userAvatar==='') ? $defautlAvatar : '/assets/uploads/'.$userAvatar;

    $workingHours = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));
    $menus = Menu::get();
    
    $workedInterval = DateUtils::intervalToString($workingHours->getWorkedInterval());
    $exitTime = DateUtils::intervalToString($workingHours->getExitTime());
    $activeClock = DateUtils::intervalToString($workingHours->getActiveClock());
  
    require_once(TEMPLATE_PATH . "/header.php");
    require_once(TEMPLATE_PATH . "/menu_left.php");
    require_once(VIEW_PATH . "/{$viewName}.php");
    require_once(TEMPLATE_PATH . "/footer.php");
  }

}